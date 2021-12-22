<?php

namespace DtmGrpc;

use Google\Protobuf\Internal\Message;

/**
 * 基础grpc基类
 * Class GrpcClient
 * @package DtmGrpc
 */
class GrpcBaseStubClient extends \Grpc\BaseStub
{
    /**
     * GrpcClient constructor.
     * @param $hostname
     * @param $opts
     * @param null $channel
     * @throws \Exception
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param string $method
     * @param Message $argument
     * @param array $deserialize
     * @param array $metadata
     * @param array $options
     * @return array
     */
    public function invoke(string $method, Message $argument, array $deserialize, array $metadata = [], array $options = []): array {
        $response = $this->_simpleRequest($method, $argument, $deserialize, $metadata, $options);
        if ($response instanceof \Grpc\UnaryCall) {
            $response = $response->wait();
        }
        return $response;
    }

}