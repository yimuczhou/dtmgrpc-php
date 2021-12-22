<?php

namespace DtmGrpc;


use DtmGrpc\Config\SagaConfig;
use DtmGrpc\GPB\DtmGimp\DtmRequest;
use Google\Protobuf\Internal\Message;

/**
 * Class Saga
 * @package DtmGrpc
 */
class Saga
{
    /**
     * @var SagaConfig
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


    public function __construct(SagaConfig $config) {
        $this->setConfig($config);
    }

    /**
     * @return SagaConfig
     */
    public function getConfig(): SagaConfig {
        return $this->config;
    }

    /**
     * @param SagaConfig $config
     */
    public function setConfig(SagaConfig $config): void {
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
     * @param string $action
     * @param string $compensate
     * @param Message $message
     * @return $this
     */
    public function addSteps(string $action, string $compensate, Message $message): Saga {
        $this->setSteps(['action' => $action, 'compensate' => $compensate,]);
        $this->setBinPayloads($message->serializeToString());
        return $this;
    }

    /**
     * @return DtmRequest
     */
    protected function buildDtmRequest(): DtmRequest {
        $gid = $this->getConfig()->getGid();
        return new DtmRequest([
            'Gid'         => $gid,
            'TransType'   => Constants::TRANS_TYPE_SAGA,
            'BinPayloads' => $this->getBinPayloads(),
            'Steps'       => json_encode($this->getSteps()),
        ]);
    }

    /**
     * @return mixed
     */
    public function submit() {
        $client   = $this->config->getDtmClient();
        $argument = $this->buildDtmRequest();
        list($response, $status) = $client->submit($argument);
        checkStatus($status);
        return $response;
    }

}