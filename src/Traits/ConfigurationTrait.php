<?php

namespace SocketLibrary\Traits;

trait ConfigurationTrait
{
    protected $configuration = null;

    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
        return $this;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }
}
