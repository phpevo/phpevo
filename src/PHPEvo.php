<?php

namespace PHPEvo;

use GuzzleHttp\Client;
use PHPEvo\Services\{InstanceService, RabbitService, SQSService, SendService};

class PHPEvo
{
    /**
     * @var SendService
     */
    public SendService $send;

    /**
     * @var InstanceService
     */
    public InstanceService $instance;

    /**
     * @var SQSService
     */
    public SQSService $sqs;

    /**
     * @var RabbitService
     */
    public RabbitService $rabbit;

    /**
     * evolution constructor.
     */
    public function __construct(
        string $apiKey,
        string $baseUrl
    ) {
        $client = new Client([
            'base_uri' => $baseUrl,
            'headers'  => [
                'content-type' => 'application/json',
                'apiKey'       => $apiKey,
            ],
        ]);

        $this->instance = new InstanceService($client);

        $this->send = new SendService($client);

        $this->sqs = new SQSService($client);

        $this->rabbit = new RabbitService($client);
    }
}
