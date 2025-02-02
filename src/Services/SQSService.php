<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use InvalidArgumentException;
use PHPEvo\Services\Enums\ValidEvents;
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance};

/**
 * Class SendService
 *
 * @package Evolution\Services
 */
class SQSService
{
    use HasHttpRequests;
    use InteractWithInstance;

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
     * @param array<string> $events
     * @return array
     */
    public function setSQS(bool $enable = true, array $events = []): array
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

        return $this->post('sqs/set/' . $this->instance, $data);
    }

    /**
     * Get SQS in our instance
     *
     * @return array
     */
    public function getSQS(): array
    {
        return $this->get('sqs/get/' . $this->instance);
    }
}
