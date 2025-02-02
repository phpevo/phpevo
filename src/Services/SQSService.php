<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use PHPEvo\Services\Interfaces\EventServiceInterface;
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance, ValidateEvents};

/**
 * Class SQSService
 *
 * @package Evolution\Services
 */
class SQSService implements EventServiceInterface
{
    use HasHttpRequests;
    use InteractWithInstance;
    use ValidateEvents;

    /**
     * SQSService constructor.
     *
     * @param Client $client
     */
    public function __construct(
        private Client $client,
    ) {
    }

    /**
     * Set SQS in our instance
     *
     * @param bool $enable
     * @param array<string> $events Events to be sent to the Webhook
     * @throws \InvalidArgumentException If an invalid event is provided
     * @return array
     */
    public function set(bool $enable = true, array $events = []): array
    {
        if (!empty($events)) {
            $this->validateEvents($events);
        }

        $data = [
            'enable' => $enable,
            'events' => $events,
        ];

        return $this->post('sqs/set/' . $this->instance, $data);
    }

    /**
     * Find SQS in our instance
     *
     * @return array
     */
    public function find(): array
    {
        return $this->get('sqs/find/' . $this->instance);
    }
}
