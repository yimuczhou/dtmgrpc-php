<?php

namespace DtmGrpc\Config;


use DtmGrpc\Client;

/**
 * Class MsgConfig
 * @package DtmGrpc\Config
 */
class MsgConfig
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
     * @var Client
     */
    protected $dtmClient;

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
     * @return Client
     */
    public function getDtmClient(): Client {
        if (empty($this->grpcClient)) {
            return $this->getDefDtmClient();
        }
        return $this->dtmClient;
    }

    /**
     * @param Client $dtmClient
     */
    public function setDtmClient(Client $dtmClient): void {
        $this->dtmClient = $dtmClient;
    }


}