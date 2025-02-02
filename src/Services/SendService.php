<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use PHPEvo\Services\Enums\MediaTypeEnum;
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance};
use stdClass;

/**
 * Class SendService
 *
 * @package Evolution\Services
 */
class SendService
{
    use HasHttpRequests;
    use InteractWithInstance;

    /**
     * SendService constructor.
     *
     * @param Client $client
     * @param string $to
     * @param string $caption
     * @param string $fileName
     */
    public function __construct(
        private Client $client,
        private string $to = '',
        private string $caption = '',
        private string $fileName = ''
    ) {
    }

    /**
     * set phone number
     *
     * @param string $to
     * @return self
     */
    public function to(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * set caption
     *
     * @param string $caption
     * @return self
     */
    public function caption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * set file name
     *
     * @param string $fileName
     * @return self
     */
    public function fileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * send text message
     *
     * @param string $message
     * @return array
     * @deprecated use text method instead
     */
    public function plainText(string $message): array
    {
        $url = 'message/sendText/' . $this->instance;

        return $this->post($url, [
            'number' => $this->to,
            'text'   => $message,
        ]);
    }

    /**
     * send text message
     *
     * @param string $message
     * @param array<mixed> $params
     *    - delay (int): Tempo de espera antes do envio (ms).
     *    - linkPreview (bool): Habilitar/Desabilitar prévia de links.
     *    - mentioned (string): Mencionar um usuário específico.
     *    - mentionsEveryOne (bool): Mencionar todos os usuários.
     * @return array
     */
    public function text(string $message, array $params = []): array
    {
        $data = array_merge([
            'number' => $this->to,
            'text'   => $message,
        ], $params);

        return $this->post('message/sendText/' . $this->instance, $data);
    }

    /**
     * send media message
     *
     * @param string $media
     * @param MediaTypeEnum $mediaType
     * @return array
     * @deprecated since version 1.0
     */
    public function media(string $media, MediaTypeEnum $mediaType): array
    {
        $endpoint = 'message/sendMedia/' . $this->instance;

        $data = [
            'number'    => $this->to,
            'mediatype' => $mediaType->value,
        ];

        if ($this->caption && $mediaType != MediaTypeEnum::AUDIO) {
            $data['caption'] = $this->caption;
        }

        if ($this->fileName && $mediaType == MediaTypeEnum::DOCUMENT) {
            $data['fileName'] = $this->fileName;
        }

        switch ($mediaType) {
            case MediaTypeEnum::IMAGE:
                $data['media'] = $media;

                break;
            case MediaTypeEnum::AUDIO:
                $data['media']     = $media;
                $data['fileName']  = 'audio.m4a';
                $data['mediatype'] = 'document';
                $data['delay']     = 1200;

                break;
            case MediaTypeEnum::VIDEO:
                $endpoint      = 'message/sendPtv/' . $this->instance;
                $data['file']  = $media;
                $data['delay'] = 1200;

                break;
            case MediaTypeEnum::DOCUMENT:
                $data['document'] = $media;

                break;
            default:
                return [
                    'error'   => 'error',
                    'message' => 'Tipo de mídia inválido.',
                ];
        }

        $response = $this->client->post($endpoint, [
            'json' => $data,
        ]);

        if ($response->getStatusCode() == 201) {
            $response = json_decode($response->getBody(), true);

            return $response;
        }

        return [
            'error'   => 'error',
            'message' => 'Erro ao enviar mensagem.' . $response->getBody(),
        ];
    }

    /**
     * send audio message
     *
     * @param string $audio
     * @return array
     */
    public function sendAudio(string $audio): array
    {
        $this->checkFileExists($audio);

        $audio = $this->prepareFile($audio);

        return $this->post('message/sendWhatsAppAudio/' . $this->instance, [
            'number' => $this->to,
            'audio'  => $audio->content,
        ]);
    }

    /**
     * send image message
     *
     * @param string $image
     * @return array
     */
    public function sendImage(string $image): array
    {
        $this->checkFileExists($image);

        $file = $this->prepareFile($image);

        $data = [
            'number'    => $this->to,
            'media'     => $file->content,
            'mediatype' => 'image',
        ];

        if ($this->caption) {
            $data['caption'] = $this->caption;
        }

        return $this->post('message/sendMedia/' . $this->instance, $data);
    }

    /**
     * send video message
     *
     * @param string $video
     * @return array
     */
    public function sendVideo(string $video): array
    {
        $this->checkFileExists($video);

        $file = $this->prepareFile($video);

        $data = [
            'number'    => $this->to,
            'media'     => $file->content,
            'mediatype' => 'video',
            'mimetype'  => $file->mimeType,
            'fileName'  => $file->fileName,
        ];

        if ($this->caption) {
            $data['caption'] = $this->caption;
        }

        return $this->post('message/sendMedia/' . $this->instance, $data);
    }

    /**
     * send document message
     *
     * @param string $document
     * @return array
     */
    public function sendDocument(string $document): array
    {
        $this->checkFileExists($document);

        $file = $this->prepareFile($document);

        return $this->post('message/sendMedia/' . $this->instance, [
            'number'    => $this->to,
            'media'     => $file->content,
            'mediatype' => 'document',
            'mimetype'  => $file->mimeType,
            'fileName'  => $file->fileName,
        ]);
    }

    /**
     * check if file exists
     *
     * @param string $file
     * @return array|boolean
     */
    private function checkFileExists(string $file): array|bool
    {
        if (!file_exists($file)) {
            return [
                'error'   => 'error',
                'message' => 'Arquivo não encontrado.',
            ];
        }

        return true;
    }

    /**
     * prepare file
     *
     * @param string $file
     * @return object
     */
    private function prepareFile(string $file): object
    {
        $handle = fopen($file, 'rb');

        if ($handle === false) {
            throw new \RuntimeException('Falha ao abrir o arquivo.');
        }

        $base64File = base64_encode(fread($handle, filesize($file)));

        fclose($handle);

        if (!$base64File) {
            throw new \RuntimeException('Falha ao codificar o arquivo em Base64.');
        }

        $filePrepared = new stdClass();

        $filePrepared->fileName = basename($file);
        $filePrepared->content  = $base64File;
        $filePrepared->mimeType = mime_content_type($file);

        return $filePrepared;
    }
}
