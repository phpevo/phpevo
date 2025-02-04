<?php

namespace PHPEvo\Services\Models\Messages;

/**
 * Class PollMessage
 *
 * @package Evolution\Services\Models
 */
class PollMessage
{
    /**
     * PollMessage constructor.
     *
     * @param string $name Poll name
     * @param int $selectableCount How many options each person can select (Required range: x > 1)
     * @param array<string> $values Poll options
     */
    public function __construct(
        public string $name,
        public int $selectableCount,
        public array $values,
    ) {
        if ($selectableCount <= 1) {
            throw new \InvalidArgumentException('Selectable count must be greater than 0');
        }
    }
}
