<?php

namespace PHPEvo\Services\Models\Messages;

/**
 * Class ReactionMessage
 *
 * @package Evolution\Services\Models\Messages
 */
class ReactionMessage
{
    /**
     * ReactionMessage constructor.
     *
     * @param  array<string, string|boolean>  $key Message key
     *  - fromMe (bool): If the message was sent by the instance owner or not
     *  - id (string): Message ID
     *  - remoteJid (string): Remote JID
     * @param  string  $reaction  Reaction emoji
     */
    public function __construct(
        public array $key,
        public string $reaction,
    ) {
        if (strlen($reaction) > 1) {
            throw new \InvalidArgumentException('Reaction must be an emoji.');
        }

        if (!isset($key['fromMe'], $key['id'], $key['remoteJid'])) {
            throw new \InvalidArgumentException('Key must contain fromMe, id and remoteJid.');
        }
    }
}
