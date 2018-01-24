<?php

namespace SocketLibrary\Responses;

class Response extends AbstractResponse
{
    /**
     * @return input
     */
    public function proccessInput()
    {
        return sprintf(
            'you are: %s, and you write: %s', 
            $this->client->getRemoteAddress(),
            $this->getInput()
        );
    }
}
