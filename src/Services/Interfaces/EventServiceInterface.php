<?php

namespace PHPEvo\Services\Interfaces;

interface EventServiceInterface
{
    public function set(bool $enable = true, array $events = []): array;

    public function find(): array;
}
