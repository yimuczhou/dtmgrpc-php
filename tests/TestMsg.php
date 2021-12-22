<?php


namespace DtmGrpc\Tests;


use DtmGrpc\Client;
use DtmGrpc\Config\MsgConfig;
use DtmGrpc\GPB\DtmGimp\DtmClient;
use DtmGrpc\Msg;
use DtmGrpc\Tests\Examples\DtmGimp\BusiReq;
use PHPUnit\Framework\TestCase;
use function DtmGrpc\genGid;

class TestMsg extends TestCase
{
    public function getConfig(): MsgConfig {
        $gid    = genGid(Constants::DTM_GRPC_SERVER);
        $config = new MsgConfig();
        $config->setGid($gid);
        $config->setDtmUrl(Constants::DTM_GRPC_SERVER);
        $config->setDtmClient(new Client(Constants::DTM_GRPC_SERVER, DtmClient::class));
        return $config;
    }

    public function getBaseData(): Msg {
        $config = $this->getConfig();
        $msg    = new Msg($config);
        $req    = new BusiReq([
            'Amount'         => 30,
            'TransOutResult' => 'SUCCESS',
            'TransInResult'  => 'SUCCESS',
        ]);
        $svc    = Constants::DTM_BUS_GRPC_SERVER;
        $msg->addSteps($svc . '/examples.Busi/TransOut', $req);
        $msg->addSteps($svc . '/examples.Busi/TransIn', $req);
        $msg->setQueryPrepared($svc . '/examples.Busi/CanSubmit');
        return $msg;
    }

    public function testPrepared() {
        $msg = $this->getBaseData();
        $msg->prepare('');
    }

    public function testSubmit() {
        $msg = $this->getBaseData();
        $msg->prepare('');
        sleep(2);
        $msg->submit();
    }

    public function testSubmitFunc() {
        $req      = new BusiReq([
            'Amount'         => 30,
            'TransOutResult' => 'SUCCESS',
            'TransInResult'  => 'SUCCESS',
        ]);
        $svc      = Constants::DTM_BUS_GRPC_SERVER;
        $steps    = [
            [
                'action' => $svc . '/examples.Busi/TransOut',
                'data'   => $req
            ],
            [
                'action' => $svc . '/examples.Busi/TransIn',
                'data'   => $req
            ]
        ];
        $prepared = $svc . '/examples.Busi/CanSubmit';
        \DtmGrpc\msgGlobalTransaction(Constants::DTM_GRPC_SERVER, $steps, $prepared);
    }

    public function testM() {
        $bid = sprintf("%02d", 11);
        var_dump($bid);
    }
}