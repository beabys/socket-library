<?php

namespace SocketLibrary\Responses;

use SocketLibrary\Traits\ConfigurationTrait;

class AbstractResponse
{
    use ConfigurationTrait;

    protected $input = '';

    /**
     * Construct
     *
     * @param $input
     */
    public function __construct($configuration, $input = '')
    {
        $this->setConfiguration($configuration);
        $this->setInput($input);
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
     * @return input
     */
    public function proccessInput()
    {
        return $this->getInput();
    }
}
