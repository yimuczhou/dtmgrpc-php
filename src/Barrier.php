<?php

namespace DtmGrpc;


use DtmGrpc\Config\BarrierConfig;

/**
 * Class Barrier
 * @package DtmGrpc
 */
class Barrier
{
    protected $config;

    protected $barrierId = 0;


    public function __construct(BarrierConfig $config) {
        $this->setConfig($config);
    }

    /**
     * @return BarrierConfig
     */
    public function getConfig(): BarrierConfig {
        return $this->config;
    }

    /**
     * @param BarrierConfig $config
     */
    public function setConfig(BarrierConfig $config): void {
        $this->config = $config;
    }

    /**
     * @return int
     */
    public function getBarrierId(): int {
        return $this->barrierId;
    }

    /**
     * @param int $barrierId
     */
    public function setBarrierId(int $barrierId): void {
        $this->barrierId = $barrierId;
    }

    /**
     * @param callable $callback
     */
    public function call(callable $callback) {
        $this->setBarrierId($this->getBarrierId() + 1);
        $bid = sprintf("%02d", $this->getBarrierId());

        $config = $this->getConfig();
        $logger = $config->getLogger();
        $op     = $config->getOp();
        $db     = $config->getDb();
        $db->beginTransaction();
        try {
            $originBranch = [
                                Constants::ACTION_TYPE_CANCEL     => Constants::ACTION_TYPE_TRY,
                                Constants::ACTION_TYPE_COMPENSATE => Constants::ACTION_TYPE_ACTION
                            ][$op] ?? "";

            $originAffected = $this->insert($config->getTransType(), $config->getGid(), $config->getBranchId(), $originBranch, $bid, $op);
            $currAffected   = $this->insert($config->getTransType(), $config->getGid(), $config->getBranchId(), $op, $bid, $op);
            $logger->info(sprintf("originAffected: %d currentAffected: %d", $originAffected, $currAffected));
            // $originAffected > 0 这个是空补偿; $currAffected == 0 这个是重复请求或悬挂
            if (in_array($op, [Constants::ACTION_TYPE_CANCEL, Constants::ACTION_TYPE_COMPENSATE]) && $originAffected > 0 || $currAffected == 0) {
                $db->commit();
                return;
            }
            $callback($this->config->getDb());
            $db->commit();
        } catch (\Throwable $e) {
            $db->rollBack();
        }

    }

    /**
     * @param string $transType
     * @param string $gid
     * @param string $branchId
     * @param string $op
     * @param string $barrierId
     * @param string $reason
     * @return int
     */
    protected function insert(string $transType, string $gid, string $branchId, string $op, string $barrierId, string $reason): int {
        if (empty($op)) {
            return 0;
        }
        $statement = $this->getConfig()->getDb()->prepare("insert ignore into dtm_barrier.barrier(trans_type, gid, branch_id, op, barrier_id, reason) values (?,?,?,?,?,?)");
        $statement->execute([$transType, $gid, $branchId, $op, $barrierId, $reason]);
        return $statement->rowCount();
    }
}