<?php

namespace SocketLibrary\Servers;

use Amp\Loop as AmpLoop;
use Amp\Socket\ServerSocket;
use SocketLibrary\Strategies\Strategy;
use Exception;
use function Amp\asyncCoroutine;
use function Amp\Socket\listen as listenSocket;
use SocketLibrary\Traits\ConfigurationTrait;
use SocketLibrary\Strategies\AbstractStrategy;

class Server
{
    use ConfigurationTrait;

    protected $host = 0;
    protected $port = 10880;
    protected $protocol = 'tcp';
    protected $trategy = 'tcp';

    public function __construct($configuration)
    {
        if (!empty($configuration)) {
            $this->setConfiguration($configuration);
            if ($this->configuration->get('socket.host')) {
                $this->setHost($this->configuration->get('socket.host'));
            }
            if ($this->configuration->get('socket.port')) {
                $this->setPort($this->configuration->get('socket.port'));
            }
            if ($this->configuration->get('socket.protocol')) {
                $this->setProtocol($this->configuration->get('socket.protocol'));
            }
        }
    }

    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

    public function getProtocol()
    {
        return $this->protocol;
    }

    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }

    public function getStrategy()
    {
        if (!($this->strategy instanceof AbstractStrategy) || is_null($this->strategy)) {
            $this->strategy = new Strategy();
        }
        return $this->strategy;
    }

    public function loop($verbose = '')
    {
        AmpLoop::run(function () use ($verbose){
            $host = $this->getHost();
            $port = $this->getPort();
            $protocol = $this->getProtocol();
            $uri = $protocol . '://' . $host . ':' . $port;
            $clientHandler = asyncCoroutine(function (ServerSocket $socket) use ($verbose) {
                while (null !== $chunk = yield $socket->read()) {
                    try {
                        if (!empty($chunk)) {
                            $responseObject = $this->getResponseObject($chunk, $socket);
                            $response = $responseObject->proccessInput();
                            if ($verbose == 'vv') {
                                echo $response . PHP_EOL;
                            }
                            $responseObject = null;
                            yield $socket->write($response);
                        }
                    } catch (Exception $e) {
                        //log exception
                    }
                }
            });
            $server = listenSocket($uri);
            while ($socket = yield $server->accept()) {
                if ($verbose === 'v' || $verbose === 'vv') {
                    echo sprintf("Accepted connection from %s." . PHP_EOL, $socket->getRemoteAddress());
                }
                $clientHandler($socket);
            }
        });
    }

    protected function getResponseObject($chunk, $client)
    {
        return $this->getStrategy()
                ->setConfiguration($this->getConfiguration())
                ->setData($chunk)
                ->setClient($client)
                ->getObjectResponse();
    }
}
