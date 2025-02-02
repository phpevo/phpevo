<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use InvalidArgumentException;
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
     * @param array $events
     * @return array
     */
    public function setSQS(bool $enable = true, array $events = []): array
    {
        $validEvents = [
            'APPLICATION_STARTUP',
            'QRCODE_UPDATED',
            'MESSAGES_SET',
            'MESSAGES_UPSERT',
            'MESSAGES_UPDATE',
            'MESSAGES_DELETE',
            'SEND_MESSAGE',
            'CONTACTS_SET',
            'CONTACTS_UPSERT',
            'CONTACTS_UPDATE',
            'PRESENCE_UPDATE',
            'CHATS_SET',
            'CHATS_UPSERT',
            'CHATS_UPDATE',
            'CHATS_DELETE',
            'GROUPS_UPSERT',
            'GROUP_UPDATE',
            'GROUP_PARTICIPANTS_UPDATE',
            'CONNECTION_UPDATE',
            'CALL',
            'NEW_JWT_TOKEN',
        ];

        foreach ($events as $event) {
            if (!in_array($event, $validEvents, true)) {
                throw new InvalidArgumentException("Evento inválido: $event");
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
