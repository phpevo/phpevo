<?php

namespace PHPEvo\Services\Traits;

use PHPEvo\Services\Enums\ValidEvents;

trait ValidateEvents
{
    /**
     * Validate if the provided events are valid.
     *
     * @param array<string> $events
     * @throws \InvalidArgumentException
     */
    public function validateEvents(array $events): void
    {
        foreach ($events as $event) {
            if (!ValidEvents::isValidEvent($event)) {
                throw new \InvalidArgumentException('Invalid event: ' . $event);
            }
        }
    }
}
