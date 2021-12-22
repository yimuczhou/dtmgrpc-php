<?php

namespace DtmGrpc\Config;


use DtmGrpc\Client;
use DtmGrpc\GPB\DtmGimp\DtmClient;
use DtmGrpc\GrpcBaseStubClient;
use function DtmGrpc\checkStatus;

trait DefaultConfig
{
    /**
     * @return Client
     */
    public function getDefDtmClient(): Client {
        return new Client($this->getDtmUrl(), DtmClient::class);
    }

    /**
     * @return \Closure
     */
    public function getDefGrpcClient(): \Closure {
        return function ($hostName) {
            return new Client($hostName, GrpcBaseStubClient::class);
        };
    }

    /**
     * @return string
     */
    public function genGid(): string {
        $client   = $this->getDtmClient();
        $argument = new \Google\Protobuf\GPBEmpty();
        /**
         * @var \DtmGrpc\GPB\DtmGimp\DtmGidReply $response
         */
        list($response, $status) = $client->newGid($argument);
        checkStatus($status);
        return $response->getGid();
    }
}