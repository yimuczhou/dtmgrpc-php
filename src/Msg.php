<?php

namespace DtmGrpc;


use DtmGrpc\Config\BarrierConfig;
use DtmGrpc\Config\MsgConfig;
use DtmGrpc\Exception\DtmFailureException;
use DtmGrpc\GPB\DtmGimp\DtmRequest;
use Google\Protobuf\Internal\Message;

/**
 * Class Msg
 * @package DtmGrpc
 */
class Msg
{
    /**
     * @var MsgConfig
     */
    protected $config;
    /**
     * @var array
     */
    protected $steps = [];
    /**
     * @var array
     */
    protected $binPayloads = [];
    /**
     * @var string
     */
    protected $queryPrepared = '';

    public function __construct(MsgConfig $config) {
        $this->setConfig($config);


    }

    /**
     * @return MsgConfig
     */
    public function getConfig(): MsgConfig {
        return $this->config;
    }

    /**
     * @param MsgConfig $config
     */
    public function setConfig(MsgConfig $config): void {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getSteps(): array {
        return $this->steps;
    }

    /**
     * @param array $steps
     */
    public function setSteps(array $steps): void {
        $this->steps[] = $steps;
    }

    /**
     * @return array
     */
    public function getBinPayloads(): array {
        return $this->binPayloads;
    }

    /**
     * @param string $binPayloads
     */
    public function setBinPayloads(string $binPayloads): void {
        $this->binPayloads[] = $binPayloads;
    }

    /**
     * @return string
     */
    public function getQueryPrepared(): string {
        return $this->queryPrepared;
    }

    /**
     * @param string $queryPrepared
     * @return $this
     */
    public function setQueryPrepared(string $queryPrepared): Msg {
        $this->queryPrepared = $queryPrepared;
        return $this;
    }

    /**
     * @param string $action
     * @param Message $message
     * @return $this
     */
    public function addSteps(string $action, Message $message): Msg {
        $this->setSteps(['action' => $action]);
        $this->setBinPayloads($message->serializeToString());
        return $this;
    }

    /**
     * @return DtmRequest
     */
    protected function buildDtmRequest(): DtmRequest {
        $gid = $this->getConfig()->getGid();
        return new DtmRequest([
            'Gid'           => $gid,
            'TransType'     => Constants::TRANS_TYPE_MSG,
            'QueryPrepared' => $this->getQueryPrepared(),
            'BinPayloads'   => $this->getBinPayloads(),
            'Steps'         => json_encode($this->getSteps()),
        ]);
    }

    /**
     * @param string $queryPrepared
     * @return $this
     */
    public function prepare(string $queryPrepared): Msg {
        if (!empty($queryPrepared)) {
            $this->setQueryPrepared($queryPrepared);
        }
        $argument = $this->buildDtmRequest();
        $client   = $this->config->getDtmClient();
        list(, $status) = $client->prepare($argument);
        checkStatus($status);
        return $this;
    }

    /**
     * 普通消息提交
     * @return mixed
     */
    public function submit() {
        $client   = $this->config->getDtmClient();
        $argument = $this->buildDtmRequest();
        list($response, $status) = $client->submit($argument);
        checkStatus($status);
        return $response;
    }

    public function abort() {
        $client   = $this->config->getDtmClient();
        $argument = $this->buildDtmRequest();
        list($response, $status) = $client->abort($argument);
        checkStatus($status);
        return $response;
    }

    /**
     * @throws \Throwable
     */
    protected function transRequestBranch(string $queryPrepared, BarrierConfig $barrierConfig) {
        list($hostName, $method) = parseHostnameAndMethod($queryPrepared);
        $func = $this->config->getGrpcClient();
        /**
         * @var Client $gRpcClient
         */
        $gRpcClient = $func($hostName);
        //调用业务try接口
        $deserialize    = ['\Google\Protobuf\GPBEmpty', 'decode'];
        $argument       = new \Google\Protobuf\GPBEmpty();
        $updateMetadata = $gRpcClient->buildMetadata($this->getConfig()->getGid(), Constants::TRANS_TYPE_MSG, $barrierConfig->getBranchId(), $barrierConfig->getOp(), $this->config->getDtmUrl());
        list($response, $status) = $gRpcClient->invoke($method, $argument, $deserialize, $updateMetadata);
        checkStatus($status);
    }

    /**
     * @throws \Throwable
     */
    public function doAndSubmit(string $queryPrepared, callable $businessCall) {
        $barrierConfig = new BarrierConfig();
        $barrierConfig->setTransType(Constants::TRANS_TYPE_MSG);
        $barrierConfig->setGid($this->getConfig()->getGid());
        $barrierConfig->setBranchId('00');
        $barrierConfig->setOp('msg');
        $bb = new Barrier($barrierConfig);

        $this->prepare($queryPrepared);
        try {
            try {
                $businessCall($bb);
            } catch (DtmFailureException $e) {
                throw  $e;
            } catch (\Exception $e) {
                $this->transRequestBranch($queryPrepared, $barrierConfig);
            }
            $this->submit();
        } catch (DtmFailureException $e) {
            $this->abort();
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    /**
     * 二阶段提交，https://dtm.pub/practice/msg.html
     * @throws \Throwable
     */
    public function doAndSubmitDb(string $queryPrepared, $db, callable $callback, $logger) {
        $this->doAndSubmit($queryPrepared, function (Barrier $bb) use ($db, $callback, $logger) {
            $bb->getConfig()->setDb($db);
            $bb->getConfig()->setLogger($logger);
            $bb->callWithDb($db, $callback);
        });
    }
}