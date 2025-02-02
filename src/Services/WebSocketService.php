<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use PHPEvo\Services\Interfaces\EventServiceInterface;
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance, ValidateEvents};

/**
 * Class WebSocketService
 *
 * @package Evolution\Services
 */
class WebSocketService implements EventServiceInterface
{
    use HasHttpRequests;
    use InteractWithInstance;
    use ValidateEvents;

    /**
     * WebSocketService constructor.
     *
     * @param Client $client
     */
    public function __construct(
        private Client $client,
    ) {
    }

    /**
     * Set WebSocket in our instance
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

        return $this->post('websocket/set/' . $this->instance, $data);
    }

    /**
     * Find WebSocket in our instance
     *
     * @return array
     */
    public function find(): array
    {
        return $this->get('websocket/find/' . $this->instance);
    }
}
