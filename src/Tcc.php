<?php

namespace DtmGrpc;

use DtmGrpc\Config\TccConfig;
use DtmGrpc\Exception\DtmTccRuntimeException;
use DtmGrpc\GPB\DtmGimp\DtmBranchRequest;
use DtmGrpc\GPB\DtmGimp\DtmRequest;
use Google\Protobuf\Internal\Message;

/**
 * Class Tcc
 * @package DtmGrpc
 */
class Tcc
{
    protected $config;

    public function __construct(TccConfig $config) {
        $this->setConfig($config);
    }

    /**
     * @return TccConfig
     */
    public function getConfig(): TccConfig {
        return $this->config;
    }

    /**
     * @param TccConfig $config
     */
    public function setConfig(TccConfig $config): void {
        $this->config = $config;
    }

    /**
     * @param callable $callback
     * @return string
     */
    public function tccGlobalTransaction(callable $callback): string {
        $dtmClient = $this->config->getDtmClient();
        $gid       = $this->config->getGid();

        $argument = new DtmRequest([
            'Gid'       => $gid,
            'TransType' => Constants::TRANS_TYPE_TCC,
        ]);
        try {
            list(, $status) = $dtmClient->prepare($argument);
            checkStatus($status);
            $callback($this);
            list(, $status) = $dtmClient->submit($argument);
            checkStatus($status);
        } catch (\Throwable $e) {
            $dtmClient->abort($argument);
            throw new DtmTccRuntimeException($e->getMessage(), $e->getCode(), $e);
        }
        return $gid;
    }

    /**
     * @param Message $message
     * @param string $tryUrl
     * @param string $confirmUrl
     * @param string $cancelUrl
     * @param array $deserialize
     * @return mixed
     */
    public function callBranch(Message $message, string $tryUrl, string $confirmUrl, string $cancelUrl, array $deserialize) {
        $branchId = $this->config->getIdGenerator()->newBranchId();
        $gid      = $this->config->getGid();

        $client   = $this->config->getDtmClient();
        $argument = new DtmBranchRequest([
            'Gid'         => $gid,
            'TransType'   => Constants::TRANS_TYPE_TCC,
            'BranchID'    => $branchId,
            'BusiPayload' => $message->serializeToString(),
            'Data'        => ['confirm' => $confirmUrl, 'cancel' => $cancelUrl]
        ]);

        list(, $status) = $client->registerBranch($argument);
        checkStatus($status);

        list($hostName, $method) = parseHostnameAndMethod($tryUrl);
        $func = $this->config->getGrpcClient();
        /**
         * @var Client $gRpcClient
         */
        $gRpcClient = $func($hostName);

        //调用业务try接口
        $updateMetadata = $gRpcClient->buildMetadata($gid, Constants::TRANS_TYPE_TCC, $branchId, Constants::ACTION_TYPE_TRY, $this->config->getDtmUrl());
        list($response, $status) = $gRpcClient->invoke($method, $message, $deserialize, $updateMetadata);
        checkStatus($status);
        return $response;
    }


}
