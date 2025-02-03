<?php

namespace PHPEvo\Services\Models\Messages;

/**
 * Class LocationMessage
 *
 * @package Evolution\Services\Models
 */
class LocationMessage
{
    /**
     * LocationMessageOptions constructor.
     *
     * @param int $latitude Location latitude
     * @param int $longitude Location longitude
     * @param string|null $name Location name
     * @param string|null $address Location address
     */
    public function __construct(
        public int     $latitude,
        public int     $longitude,
        public ?string $name = null,
        public ?string $address = null,
    ) {
    }
}
