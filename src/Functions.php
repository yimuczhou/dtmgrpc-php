<?php

namespace DtmGrpc;


use DtmGrpc\Config\MsgConfig;
use DtmGrpc\Config\SagaConfig;
use DtmGrpc\Config\TccConfig;
use DtmGrpc\Exception\DtmFailureException;
use DtmGrpc\Exception\DtmGrpcConnectionException;
use DtmGrpc\Exception\DtmGrpcUnknownException;
use DtmGrpc\GPB\DtmGimp\DtmClient;
use DtmGrpc\Client;

if (!function_exists('parseHostnameAndMethod')) {
    /**
     * 将grpc的url分解为hostname和method
     * @param string $url
     * @return array
     */
    function parseHostnameAndMethod(string $url): array {
        $path     = explode('/', $url);
        $hostname = $path[0];
        array_shift($path);
        $method = implode('/', $path);
        return [$hostname, $method];
    }
}

if (!function_exists('genGid')) {
    /**
     * 生成id
     * @param string $dtmUrl
     * @return string
     */
    function genGid(string $dtmUrl): string {
        $client   = new Client($dtmUrl, DtmClient::class);
        $argument = new \Google\Protobuf\GPBEmpty();
        /**
         * @var \DtmGrpc\GPB\DtmGimp\DtmGidReply $response
         */
        list($response, $status) = $client->newGid($argument);
        checkStatus($status);
        return $response->getGid();
    }
}

if (!function_exists('checkStatus')) {
    /**
     * 校验grpc返回状态
     * @param \stdClass $status
     */
    function checkStatus(\stdClass $status) {
        //网络问题
        if ($status->code == 14) {
            throw new DtmGrpcConnectionException('Dtm server connection is not a valid ');
        }
        //服务器端执行失败
        if ($status->code == 10 || stripos($status->details, 'FAILURE') !== false) {
            throw new DtmFailureException('gRpc server fails to execute, err:' . $status->details);
        }
        //其他异常错误
        if ($status->code != 0) {
            throw new DtmGrpcUnknownException('Unknown exception，err:' . $status->details);
        }
    }
}

if (!function_exists('tccGlobalTransaction')) {
    /**
     * tcc全局事务
     * @param string $dtmUrl
     * @param callable $cb
     * @return string
     */
    function tccGlobalTransaction(string $dtmUrl, callable $cb): string {
        $config = new TccConfig();
        $config->setDtmUrl($dtmUrl);
        $config->setGid($config->genGid());
        $config->setIdGenerator(new IdGenerator());
        $tcc = new Tcc($config);
        return $tcc->tccGlobalTransaction($cb);
    }
}

if (!function_exists('msgGlobalTransaction')) {
    /**
     * @param string $dtmUrl
     * @param array $steps
     * @param string $queryPrepared
     * @return mixed
     */
    function msgGlobalTransaction(string $dtmUrl, array $steps, string $queryPrepared) {
        $config = new MsgConfig();
        $config->setDtmUrl($dtmUrl);
        $config->setGid($config->genGid());
        $msg = new Msg($config);
        foreach ($steps as $step) {
            $msg->addSteps($step['action'], $step['data']);
        }
        $msg->setQueryPrepared($queryPrepared);
        return $msg->submit();
    }
}

if (!function_exists('sagaGlobalTransaction')) {
    /**
     * @param string $dtmUrl
     * @param array $steps
     * @return mixed
     */
    function sagaGlobalTransaction(string $dtmUrl, array $steps) {
        $config = new SagaConfig();
        $config->setDtmUrl($dtmUrl);
        $config->setGid($config->genGid());
        $msg = new Saga($config);
        foreach ($steps as $step) {
            $msg->addSteps($step['action'], $step['compensate'], $step['data']);
        }
        return $msg->submit();
    }
}

