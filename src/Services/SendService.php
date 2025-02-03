<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use PHPEvo\Services\Enums\{MediaTypeEnum, PresenceTypeEnum};
use PHPEvo\Services\Models\{Messages\ContactMessage, Messages\LocationMessage, Messages\ReactionMessage, PreparedFile};
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance};

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
     * @return array<string, mixed>
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
     * @param array<mixed, mixed> $params
     *    - delay (int): Tempo de espera antes do envio (ms).
     *    - linkPreview (bool): Habilitar/Desabilitar prévia de links.
     *    - mentioned (string): Mencionar um usuário específico.
     *    - mentionsEveryOne (bool): Mencionar todos os usuários.
     * @return array<string, mixed>
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
     * @return array<string, mixed>
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
            /** @var array<string, mixed> */
            return json_decode($response->getBody(), true);
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
     * @return array<string, mixed>
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
     * @return array<string, mixed>
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
     * @return array<string, mixed>
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
     * @return array<string, mixed>
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
     * send contact message
     *
     * @param ContactMessage $contact
     * @param array<string, mixed>|null $options
     *  - delay (int): Tempo de espera antes do envio (ms).
     *  - presence (PresenceTypeEnum): Tipo de presença a ser exibido
     * @return array<string, mixed>
     */
    public function sendContact(ContactMessage $contact, ?array $options = null): array
    {
        if (isset($options['presence']) && is_string($options['presence']) && !PresenceTypeEnum::isValid($options['presence'])) {
            throw new \RuntimeException('Tipo de presença inválido.');
        }

        // When field is empty, it will be removed from the array
        $contactMessage = array_filter([
            'fullName'     => $contact->fullName,
            'wuid'         => $contact->wuid,
            'phoneNumber'  => $contact->phoneNumber,
            'organization' => $contact->organization,
            'email'        => $contact->email,
            'url'          => $contact->url,
        ], fn ($value) => !empty($value));

        $data = [
            'number'         => $this->to,
            'options'        => $options,
            'contactMessage' => [$contactMessage],
        ];

        return $this->post('message/sendContact/' . $this->instance, $data);
    }
  
    /**
     * send location message
     *
     * @param LocationMessage $locationMessage
     * @param array<string, mixed>|null $options
     * - delay (int): Presence time in milliseconds before sending message.
     * - mentioned (array<string>): Mention a specific user.
     * - mentionsEveryOne (bool): Mention all users.
     * - quoted <array<string, mixed>>: Quoted message.
     * @return array<string, mixed>
     */
    public function sendLocation(LocationMessage $locationMessage, ?array $options): array
    {
        $data = [
            'number'           => $this->to,
            'name'             => $locationMessage->name,
            'address'          => $locationMessage->address,
            'latitude'         => $locationMessage->latitude,
            'longitude'        => $locationMessage->longitude,
            'delay'            => $options['delay'] ?? null,
            'quoted'           => $options['quoted'] ?? null,
            'mentionsEveryOne' => $options['mentionsEveryOne'] ?? null,
            'mentioned'        => $options['mentioned'] ?? [],
        ];

        $data = array_filter($data, fn ($value) => $value !== null);

        return $this->post('message/sendLocation/' . $this->instance, $data);
    }

    /**
     * send reaction message
     *
     * @param ReactionMessage $message
     * @return array<string, mixed>
     */
    public function sendReaction(ReactionMessage $message): array
    {
        $data = [
            'reactionMessage' => [
                'key'      => $message->key,
                'reaction' => $message->reaction,
            ],
        ];

        return $this->post('message/sendReaction/' . $this->instance, $data);
    }

    /**
     * check if file exists
     *
     * @param string $file
     * @return array<string, string>|boolean
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
     * @return PreparedFile
     */
    private function prepareFile(string $file): PreparedFile
    {
        if (!is_readable($file)) {
            throw new \RuntimeException("Arquivo não pode ser lido: {$file}");
        }

        $content = file_get_contents($file);

        if ($content === false) {
            throw new \RuntimeException("Erro ao ler o arquivo: {$file}");
        }

        $base64File = base64_encode($content);

        $mime = mime_content_type($file);

        if ($mime === false) {
            throw new \RuntimeException("Erro ao obter o tipo MIME do arquivo.");
        }

        return new PreparedFile(
            fileName: basename($file),
            content: $base64File,
            mimeType: $mime,
        );
    }
}
