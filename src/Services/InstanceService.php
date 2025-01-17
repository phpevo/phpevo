<?php

namespace PHPEvo\Services;

class InstanceService implements Interfaces\InstanceServiceInterface
{
    use Traits\HasHttpRequests;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var array<string, mixed>
     */
    private array $instance;

    /**
     * InstanceService constructor.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(
        private \GuzzleHttp\Client $client,
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
     * Create instance
     *
     * @return array<string, mixed>
     */
    public function create(): array
    {
        if (empty($this->name)) {
            throw new \Exception('Instance name is required.');
        }

        $instance = $this->post('instance/create', [
            'instanceName' => $this->name,
            'qrcode'       => true,
            'integration'  => 'WHATSAPP-BAILEYS', // WHATSAPP-BAILEYS | WHATSAPP-BUSINESS | EVOLUTION (Default WHATSAPP-BAILEYS)
        ]);

        if (array_key_exists('error', $instance)) {
            throw new \Exception($instance['message']);
        }

        $this->instance = $this->formatResponseInstance($instance);

        return $this->instance;
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
    public function connect(): array
    {
        if (empty($this->name)) {
            throw new \Exception('Instance name is required.');
        }

        $response = $this->get('instance/connect/' . $this->name);

        return [
            'qrcode' => $response['base64'],
        ];
    }

    /**
     * disconnect instance
     *
     * @return bool
     */
    public function disconnect(): bool
    {
        if (empty($this->name)) {
            throw new \Exception('Instance name is required.');
        }

        $response = $this->delete('instance/logout/' . $this->name);

        return  $response['message'] == 'success';
    }

    /**
     * destroy instance
     *
     * @return bool
     */
    public function destroy(): bool
    {
        if (empty($this->name)) {
            throw new \Exception('Instance name is required.');
        }

        $response = $this->delete('instance/delete/' . $this->name);

        return $response['message'] == 'success';
    }

    /**
     * get connection state
     *
     * @return array
     */
    public function getState(): array
    {
        if (empty($this->name)) {
            throw new \Exception('Instance name is required.');
        }

        $state = $this->get('instance/connectionState/' . $this->name);

        return [
            'state' => $state['instance']['state'],
        ];
    }

    /**
     * format response instance
     *
     * @param array $instance
     * @return array
     */
    private function formatResponseInstance(array $instance): array
    {
        return [
            'qrcode' => $instance['qrcode']['base64'],
        ];
    }
}
