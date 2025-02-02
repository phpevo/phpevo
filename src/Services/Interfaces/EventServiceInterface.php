<?php

namespace PHPEvo\Services\Interfaces;

interface EventServiceInterface
{
    /**
     * Set WebSocket in our instance
     *
     * @param bool $enable
     * @param array<string> $events Events to be sent to the Webhook
     * @return array<string, mixed>
     */
    public function set(bool $enable = true, array $events = []): array;

    /**
     * @return array<string, mixed>
     */
    public function find(): array;
}
