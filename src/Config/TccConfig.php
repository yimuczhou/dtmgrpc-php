<?php

namespace DtmGrpc\Config;

use DtmGrpc\Client;
use DtmGrpc\IdGenerator;

/**
 * Class TccConfig
 * @package DtmGrpc\Config
 */
class TccConfig
{
    /**
     * @var string
     */
    protected $dtmUrl;
    /**
     * @var string
     */
    protected $gid;

    /**
     * @var IdGenerator
     */
    protected $idGenerator;

    /**
     * @var Client
     */
    protected $dtmClient;

    /**
     * @var
     */
    protected $grpcClient;

    use DefaultConfig;

    /**
     * @return string
     */
    public function getDtmUrl(): string {
        return $this->dtmUrl;
    }

    /**
     * @param string $dtmUrl
     */
    public function setDtmUrl(string $dtmUrl): void {
        $this->dtmUrl = $dtmUrl;
    }

    /**
     * @return string
     */
    public function getGid(): string {
        return $this->gid;
    }

    /**
     * @param string $gid
     */
    public function setGid(string $gid): void {
        $this->gid = $gid;
    }

    /**
     * @return IdGenerator
     */
    public function getIdGenerator(): IdGenerator {
        return $this->idGenerator;
    }

    /**
     * @param IdGenerator $idGenerator
     */
    public function setIdGenerator(IdGenerator $idGenerator): void {
        $this->idGenerator = $idGenerator;
    }

    /**
     * @return Client
     */
    public function getDtmClient(): Client {
        if (empty($this->grpcClient)) {
            return $this->getDefDtmClient();
        }
        return $this->dtmClient;
    }

    /**
     * @param mixed $dtmClient
     */
    public function setDtmClient($dtmClient): void {
        $this->dtmClient = $dtmClient;
    }

    /**
     * @return mixed
     */
    public function getGrpcClient() {
        if (empty($this->grpcClient)) {
            return $this->getDefGrpcClient();
        }
        return $this->grpcClient;
    }

    /**
     * @param callable $client
     */
    public function setGrpcClient(callable $client): void {
        $this->grpcClient = $client;
    }


}