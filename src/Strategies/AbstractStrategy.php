<?php

namespace SocketLibrary\Strategies;

use SocketLibrary\Traits\ConfigurationTrait;
use SocketLibrary\Responses\Response;

abstract class AbstractStrategy implements StrategyInterface
{
    use ConfigurationTrait;

    protected $data = null;
    protected $client = null;

    public function setData($data)
    {
        $this->data = $this->sanitizeInput($data);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getObjectResponse()
    {
        $objectStrategy = null;
        $case = $this->typeResponse();
        switch (true) {
            default:
                $objectStrategy = new Response(
                    $this->getConfiguration(), 
                    $this->getData(),
                    $this->getClient()
                );
                break;
        }
        return $objectStrategy;
    }

    protected function typeResponse()
    {
        return;
    }

    protected function sanitizeInput($input)
    {
        return preg_replace("[ \t\n\r]", '', $input);
    }
}
