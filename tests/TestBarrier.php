<?php

namespace DtmGrpc\Tests;


use DtmGrpc\Barrier;
use DtmGrpc\Config\BarrierConfig;
use PHPUnit\Framework\TestCase;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class TestBarrier
 * @package DtmGrpc\Tests
 */
class TestBarrier extends TestCase
{

    public function getDb(): \PDO {
        return new \PDO('mysql:dbname=dtm_barrier;host=127.0.0.1;port=3307', 'root', '123456');
    }

    public function getLogger(): Logger {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('php://stdout', Logger::INFO));
        return $log;
    }

    public function testCall() {
        $config = new BarrierConfig();
        $config->setDb($this->getDb());
        $config->setLogger($this->getLogger());
        $config->setTransType('tcc');
        $config->setGid('ac106f02_4oWe3cHusqq');
        $config->setBranchId('01');
        $config->setOp('try');

        $barrier = new Barrier($config);
        $barrier->call(function ($db) {
            return true;
        });
    }
}