<?php

namespace PHPEvo;

use GuzzleHttp\Client;
use PHPEvo\Services\{InstanceService, SendService};

class PHPEvo
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var SendService
     */
    public SendService $send;

    /**
     * @var InstanceService
     */
    public InstanceService $instance;

    /**
     * evolution constructor.
     */
    public function __construct(
        string $apiKey,
        string $baseUrl,
        string $instanceName = 'whatsapp'
    ) {
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers'  => [
                'content-type' => 'application/json',
                'apiKey'       => $apiKey,
            ],
        ]);

        $this->instance = new InstanceService($this->client);

        $this->send = new SendService($instanceName, $this->client);
    }

    /**
     * @return SendService
     */
    public function send(string $instance): SendService
    {
        return new SendService($instance, $this->client);
    }

    /**
     * @return InstanceService
     */
    public function instance(): InstanceService
    {
        return new InstanceService($this->client);
    }
}
