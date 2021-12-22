<?php

namespace DtmGrpc;

/**
 * Class IdGenerator
 * @package DtmGrpc
 */
class IdGenerator
{
    private $parentId;
    private $branchId;

    public function __construct(string $parentId = '') {
        $this->parentId = $parentId;
        $this->branchId = 0;
    }

    public function newBranchId(): string {
        if ($this->branchId >= 99) {
            throw new \InvalidArgumentException('Branch id is larger than 99');
        }
        if (strlen($this->parentId) > 20) {
            throw new \InvalidArgumentException('Total branch id is longer than 20');
        }
        $this->branchId = $this->branchId + 1;
        return $this->parentId . str_pad($this->branchId, 2, '0');
    }
}
