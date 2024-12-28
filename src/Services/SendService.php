<?php

namespace PHPEvo\Services;

use PHPEvo\Services\Enums\MediaTypeEnum;
use GuzzleHttp\Client;
use PHPEvo\Services\Traits\HasHttpRequests;

/**
 * Class SendService
 *
 * @package Evolution\Services
 */
class SendService
{
    use HasHttpRequests;

    /**
     * SendService constructor.
     *
     * @param string $instance
     * @param string $to
     * @param string $caption
     * @param string $fileName
     * @param boolean $mentions
     */
    public function __construct(
        private string $instance,
        private Client $client,
        private string $to = '',
        private string $caption = '',
        private string $fileName = '',
        private bool $mentions = false
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
     * set mentions
     *
     * @param bool $mentions
     * @return self
     */
    public function mentionsEveryOne(bool $mentions): self
    {
        $this->mentions = $mentions;

        return $this;
    }

    /**
     * send text message
     *
     * @param string $message
     * @return array
     */
    public function plainText(string $message): array
    {
        $url = 'message/sendText/' . $this->instance;

        return $this->post($url, [
            'number' => $this->to,
            'text' => $message,
        ]);
    }

    /**
     * send media message
     *
     * @param string $media
     * @param MediaTypeEnum $mediaType
     * @return array
     */
    public function media(string $media, MediaTypeEnum $mediaType): array
    {
        $endpoint = 'message/sendMedia/' . $this->instance;

        $data = [
            'number' => $this->to,
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
                $data['media'] = $media;
                $data['fileName'] = 'audio.m4a';
                $data['mediatype'] = 'document';
                $data['delay'] = 1200;
                break;
            case MediaTypeEnum::VIDEO:
                $endpoint = 'message/sendPtv/' . $this->instance;
                $data['file'] = $media;
                $data['delay'] = 1200;
                break;
            case MediaTypeEnum::DOCUMENT:
                $data['document'] = $media;
                break;
            default:
                return [
                    'error' => 'error',
                    'message' => 'Tipo de mídia inválido.',
                ];
        }

        $response = $this->client->post($endpoint, [
            'json' => $data,
        ]);

        if ($response->getStatusCode()  == 201) {
            $response = json_decode($response->getBody(), true);

            return $response;
        }

        return [
            'error' => 'error',
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

        $url = 'message/sendWhatsAppAudio/' . $this->instance;
        $audio = base64_encode(file_get_contents($audio));

        return $this->post($url, [
            'number' => $this->to,
            'audio' => $audio,
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

        $url = 'message/sendMedia/' . $this->instance;
        $image = base64_encode(file_get_contents($image));

        $data = [
            'number' => $this->to,
            'media' => $image,
            'mediatype' => 'image',
            'caption' => $this->caption,
        ];

        if ($this->caption) {
            $data['caption'] = $this->caption;
        }

        return $this->post($url, $data);
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

        $url = 'message/sendPtv/' . $this->instance;
        $video = base64_encode(file_get_contents($video));

        $data = [
            'number' => $this->to,
            'file' => $video,
            'delay' => 1200,
        ];

        return $this->post($url, $data);
    }

    /**
     * check if file exists
     *
     * @param string $file
     * @return array|boolean
     */
    private function checkFileExists(string $file): array|bool
    {
        if (! file_exists($file)) {
            return [
                'error' => 'error',
                'message' => 'Arquivo não encontrado.',
            ];

            exit;
        }

        return true;
    }
}
