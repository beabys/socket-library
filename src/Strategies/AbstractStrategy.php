<?php

namespace SocketLibrary\Strategies;

use SocketLibrary\Traits\ConfigurationTrait;
use SocketLibrary\Responses\Response;

abstract class AbstractStrategy implements StrategyInterface
{
    use ConfigurationTrait;

    protected $data = null;
    protected $configuration = null;

    public function __construct($configuration)
    {
        $this->setConfiguration($configuration);
    }

    public function setData($data)
    {
        $this->data = $this->cleanInput($data);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getObjectResponse()
    {
        print_r($this->getData());
        $objectStrategy = null;
        $case = $this->typeResponse();
        switch (true) {
            default:
                $objectStrategy = new Response($this->getConfiguration(), $this->getData());
                break;
        }
        return $objectStrategy;
    }

    protected function typeResponse()
    {
        return;
    }

    protected function cleanInput($input)
    {
        return preg_replace("[ \t\n\r]", '', $input);
    }
}
