<?php

namespace SocketLibrary\Strategies;

interface StrategyInterface
{
    public function setData($data);

    public function getData();

    public function getObjectResponse();
}
