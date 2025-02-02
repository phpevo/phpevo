<?php

namespace PHPEvo\Services\Traits;

/**
 * Trait InteractWithInstance
 *
 * @package PHPEvo\Services\Traits
 */
trait InteractWithInstance
{
    /**
     * @var string
     */
    private string $instance;

    /**
     * set instance
     *
     * @param string $instance
     * @return self
     */
    public function instance(string $instance): self
    {
        $this->instance = $instance;

        return $this;
    }
}
