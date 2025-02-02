<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use PHPEvo\Services\Interfaces\EventServiceInterface;
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance, ValidateEvents};

class RabbitService implements EventServiceInterface
{
    use HasHttpRequests;
    use InteractWithInstance;
    use ValidateEvents;

    /**
     * RabbitService constructor.
     *
     * @param Client $client
     */
    public function __construct(
        private Client $client,
    ) {
    }

    /**
     * Set Rabbit in our instance
     *
     * @param bool $enable
     * @param array<string> $events Events to be sent to the Webhook
     * @throws \InvalidArgumentException If an invalid event is provided
     * @return array<string, mixed>
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

        return $this->post('rabbitmq/set/' . $this->instance, $data);
    }

    /**
     * Find Rabbit in our instance
     *
     * @return array<string, mixed>
     */
    public function find(): array
    {
        return $this->get('rabbitmq/find/' . $this->instance);
    }
}
