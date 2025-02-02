<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use InvalidArgumentException;
use PHPEvo\Services\Enums\ValidEvents;
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance};

class RabbitService
{
    use HasHttpRequests;
    use InteractWithInstance;

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
     * @throws InvalidArgumentException If an invalid event is provided
     * @return array
     */
    public function setRabbit(bool $enable = true, array $events = []): array
    {
        if (!empty($events)) {
            foreach ($events as $event) {
                if (!ValidEvents::isValidEvent($event)) {
                    throw new InvalidArgumentException('Invalid event: ' . $event);
                }
            }
        }

        $data = [
            'enable' => $enable,
            'events' => $events,
        ];

        return $this->post('rabbitmq/set/' . $this->instance, $data);
    }

    /**
     * Get Rabbit in our instance
     *
     * @return array
     */
    public function getRabbit(): array
    {
        return $this->get('rabbitmq/find/' . $this->instance);
    }
}
