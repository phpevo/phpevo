<?php

namespace PHPEvo\Services;

use GuzzleHttp\Client;
use PHPEvo\Services\Enums\{MediaTypeEnum, PresenceTypeEnum};
use PHPEvo\Services\Models\{Messages\ContactMessage,
    Messages\LocationMessage,
    Messages\PollMessage,
    Messages\ReactionMessage,
    PreparedFile};
use PHPEvo\Services\Traits\{HasHttpRequests, InteractWithInstance};

/**
 * Class SendService
 *
 * @package Evolution\Services
 */
class ChatService
{
    use HasHttpRequests;
    use InteractWithInstance;

    /**
     * ChatService constructor.
     *
     * @param Client $client
     */
    public function __construct(
        private Client $client
    ) {
    }

    /**
     * Check if the phone number is registered on WhatsApp.
     *
     * @param string $phoneNumber
     * @return array
     */
    public function checkNumber(string $phoneNumber): array
    {
        $url = "chat/whatsappNumbers/{$this->instance}";
        return $this->post($url, [
            'numbers' => [$phoneNumber]
        ]);
    }
}
