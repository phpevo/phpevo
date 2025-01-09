<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use PHPEvo\Services\Traits\HasHttpRequests;

class InstanceService
{
    use HasHttpRequests;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var array
     */
    private array $instance;

    /**
     * InstanceService constructor.
     *
     * @param Client $client
     */
    public function __construct(
        private Client $client,
    ) {
    }

    /**
     * set instance name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * create instance
     *
     * @return array|self
     */
    public function create(): array|self
    {
        $instance = $this->post('instance/create', [
            'instanceName' => $this->name,
            'qrcode' => true,
            'integration' => 'WHATSAPP-BAILEYS' // WHATSAPP-BAILEYS | WHATSAPP-BUSINESS | EVOLUTION (Default WHATSAPP-BAILEYS)
        ]);

        $this->instance = $instance;

        return $this;
    }

    /**
     * get instance
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->get('instance/fetchInstances');
    }

    /**
     * connect instance
     *
     * @return array
     */
    public function connect(): string
    {
        $instance = $this->get('instance/connect/' . $this->name);

        return $this->generateQrCode($instance);
    }

    /**
     * disconnect instance
     *
     * @return array
     */
    public function disconnect(): array
    {
        return $this->delete('instance/logout/' . $this->name);
    }

    /**
     * destroy instance
     *
     * @return array
     */
    public function destroy(): array
    {
        return $this->delete('instance/delete/' . $this->name);
    }

    /**
     * get connection state
     *
     * @return array
     */
    public function getState(): array
    {
        return $this->get('instance/connectionState/' . $this->name);
    }

    /**
     * generate QR code
     *
     * @param array $instance
     * @return string
     */
    private function generateQrCode(array $instance): string
    {
        $filePath = __DIR__ . '/Temp/qrcode.png';

        if (!is_dir(__DIR__ . '/Temp')) {
            mkdir(__DIR__ . '/Temp');
        }

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $qrcode = preg_replace('/^data:image\/\w+;base64,/', '', $instance['base64']);
        $qrcode = base64_decode($qrcode);

        if ($qrcode === false) {
            die('Falha ao decodificar a string Base64.');
        }

        if (file_put_contents($filePath, $qrcode) === false) {
            die('Falha ao salvar a imagem PNG.');
        }

        return $filePath;
    }
}
