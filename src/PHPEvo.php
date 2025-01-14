<?php

namespace PHPEvo;

use PHPEvo\Services\SendService;
use GuzzleHttp\Client;
use PHPEvo\Services\InstanceService;

class PHPEvo
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * evolution constructor.
     */
    public function __construct(
        private string $apiKey,
        private string $baseUrl
    ) {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'content-type' => 'application/json',
                'apiKey' => $apiKey,
            ]
        ]);
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
