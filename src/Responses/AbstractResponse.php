<?php

namespace SocketLibrary\Responses;

use SocketLibrary\Traits\ConfigurationTrait;

class AbstractResponse
{
    use ConfigurationTrait;

    protected $input = '';
    protected $client = null;

    /**
     * Construct
     *
     * @param $input
     */
    public function __construct($configuration, $input = '', $client = null)
    {
        $this->setConfiguration($configuration);
        $this->setInput($input);
        $this->setClient($client);
    }

    /**
     * setInput
     *
     * @param $input
     */
    public function setInput($input)
    {
        $this->input = $input;
        return $this;
    }

    /**
     * getInput
     */
    public function getInput()
    {
        return $this->input;
    }
    /**
     * seClient
     *
     * @param $client
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * getInput
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return input
     */
    public function proccessInput()
    {
        return $this->getInput();
    }
}
