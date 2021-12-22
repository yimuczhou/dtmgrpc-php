<?php


namespace DtmGrpc\Tests;


use DtmGrpc\Tests\Examples\DtmGimp\BusiReq;
use PHPUnit\Framework\TestCase;

class TestTcc extends TestCase
{
    public function testGenGid() {
        $gid = \DtmGrpc\genGid(Constants::DTM_GRPC_SERVER);
        print_r($gid);
        $this->assertIsString($gid, 'Is Not string');
    }

    public function testTcc() {
        $svc    = Constants::DTM_BUS_GRPC_SERVER;
        $dtmUrl = Constants::DTM_GRPC_SERVER;
        \DtmGrpc\tccGlobalTransaction($dtmUrl, function ($tcc) use ($svc) {
            /** @var \DtmGrpc\Tcc $tcc */
            //FAILURE,SUCCESS
            $req = new BusiReq([
                'Amount'         => 30,
                'TransOutResult' => 'SUCCESS',
                'TransInResult'  => 'SUCCESS',
            ]);

            echo $tcc->getConfig()->getGid() . PHP_EOL;

            $desc = ['\Google\Protobuf\GPBEmpty', 'decode'];

            $tcc->callBranch($req, $svc . '/examples.Busi/TransOut', $svc . '/examples.Busi/TransOutConfirm', $svc . '/examples.Busi/TransOutRevert', $desc);

            $tcc->callBranch($req, $svc . '/examples.Busi/TransIn', $svc . '/examples.Busi/TransInConfirm', $svc . '/examples.Busi/TransInRevert', $desc);
        });
    }
}