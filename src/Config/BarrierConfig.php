<?php

namespace DtmGrpc\Config;


use Psr\Log\LoggerInterface;

class BarrierConfig
{
    /**
     * @var \PDO
     */
    protected  $db;
    /**
     * @var LoggerInterface
     */
    protected  $logger;

    /**
     * @var string
     */
    protected  $transType;
    /**
     * @var string
     */
    protected  $gid;
    /**
     * @var string
     */
    protected  $branchId;
    /**
     * @var string
     */
    protected  $op;

    /**
     * @return \PDO
     */
    public function getDb(): \PDO {
        return $this->db;
    }

    /**
     * @param \PDO $db
     */
    public function setDb(\PDO $db): void {
        $this->db = $db;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void {
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function getTransType(): string {
        return $this->transType;
    }

    /**
     * @param string $transType
     */
    public function setTransType(string $transType): void {
        $this->transType = $transType;
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
     * @return string
     */
    public function getBranchId(): string {
        return $this->branchId;
    }

    /**
     * @param string $branchId
     */
    public function setBranchId(string $branchId): void {
        $this->branchId = $branchId;
    }

    /**
     * @return string
     */
    public function getOp(): string {
        return $this->op;
    }

    /**
     * @param string $op
     */
    public function setOp(string $op): void {
        $this->op = $op;
    }

}