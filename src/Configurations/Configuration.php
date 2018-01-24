<?php

namespace SocketLibrary\Configurations;

class Configuration
{
    protected $config = [];

    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * @param string $name
     */
    public function get($name = null)
    {
        if (is_null($name)) {
            return $this->getConfig();
        }
        return array_get($this->getConfig(), $name);
    }

    /**
     * @return array
     */
    protected function getConfig()
    {
        return $this->config;
    }
}
