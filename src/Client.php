<?php

namespace DtmGrpc;

use DtmGrpc\GPB\DtmGimp\DtmBranchRequest;
use DtmGrpc\GPB\DtmGimp\DtmRequest;
use Google\Protobuf\GPBEmpty;
use Google\Protobuf\Internal\Message;

/**
 * 对gRpc client进行封装，进行注入适配不同的框架的生成的client
 * Class Client
 */
class Client
{
    /**
     * @var string
     */
    protected $hostName;

    /**
     * @var mixed
     */
    protected $dtmClient;

    /**
     * Client constructor.
     * @param string $hostName
     * @param string $dtmClientClass
     */
    public function __construct(string $hostName, string $dtmClientClass) {
        $this->hostName  = $hostName;
        $this->dtmClient = new $dtmClientClass($hostName, [
            'credentials' => null,
        ]);
    }

    /**
     * @param DtmRequest $argument
     * @param array $metadata
     * @param array $options
     * @return array
     */
    public function prepare(DtmRequest $argument, array $metadata = [], array $options = []): array {
        $response = $this->dtmClient->Prepare($argument, $metadata, $options);
        if ($response instanceof \Grpc\UnaryCall) {
            $response = $response->wait();
        }
        return $response;
    }

    /**
     * @param DtmRequest $argument
     * @param array $metadata
     * @param array $options
     * @return array
     */
    public function submit(DtmRequest $argument, array $metadata = [], array $options = []): array {
        $response = $this->dtmClient->Submit($argument, $metadata, $options);
        if ($response instanceof \Grpc\UnaryCall) {
            $response = $response->wait();
        }
        return $response;
    }

    /**
     * @param DtmRequest $argument
     * @param array $metadata
     * @param array $options
     * @return array
     */
    public function abort(DtmRequest $argument, array $metadata = [], array $options = []): array {
        $response = $this->dtmClient->Abort($argument, $metadata, $options);
        if ($response instanceof \Grpc\UnaryCall) {
            $response = $response->wait();
        }
        return $response;
    }

    /**
     * @param DtmBranchRequest $argument
     * @param array $metadata
     * @param array $options
     * @return array
     */
    public function registerBranch(DtmBranchRequest $argument, array $metadata = [], array $options = []): array {
        $response = $this->dtmClient->RegisterBranch($argument, $metadata, $options);
        if ($response instanceof \Grpc\UnaryCall) {
            $response = $response->wait();
        }
        return $response;
    }

    /**
     * @param GPBEmpty $argument
     * @param array $metadata
     * @param array $options
     * @return array
     */
    public function newGid(GPBEmpty $argument, array $metadata = [], array $options = []): array {
        $response = $this->dtmClient->NewGid($argument, $metadata, $options);
        if ($response instanceof \Grpc\UnaryCall) {
            $response = $response->wait();
        }
        return $response;
    }

    /**
     * 原生调用方式
     * @param string $method
     * @param Message $argument
     * @param array $deserialize
     * @param array $metadata
     * @param array $options
     * @return array
     */
    public function invoke(string $method, Message $argument, array $deserialize, array $metadata = [], array $options = []): array {
        return $this->dtmClient->invoke($method, $argument, $deserialize, $metadata, $options);
    }

    /**
     * @param string $gid
     * @param string $transType
     * @param string $brandId
     * @param string $op
     * @param string $dtm
     * @return \string[][]
     */
    public function buildMetadata(string $gid, string $transType, string $brandId, string $op, string $dtm): array {
        return [
            'dtm-gid'        => [$gid],
            'dtm-trans_type' => [$transType],
            'dtm-branch_id'  => [$brandId],
            'dtm-op'         => [$op],
            'dtm-dtm'        => [$dtm],
        ];
    }
}