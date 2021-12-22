<?php



namespace DtmGrpc\Tests;


use DtmGrpc\Client;
use DtmGrpc\Config\MsgConfig;
use DtmGrpc\Config\SagaConfig;
use DtmGrpc\GPB\DtmGimp\DtmClient;
use DtmGrpc\Msg;
use DtmGrpc\Saga;
use DtmGrpc\Tests\Examples\DtmGimp\BusiReq;
use PHPUnit\Framework\TestCase;
use function DtmGrpc\genGid;

class TestSaga extends TestCase
{
    public function getConfig(): SagaConfig {
        $gid    = genGid(Constants::DTM_GRPC_SERVER);
        $config = new SagaConfig();
        $config->setGid($gid);
        $config->setDtmUrl(Constants::DTM_GRPC_SERVER);
        $config->setDtmClient(new Client(Constants::DTM_GRPC_SERVER, DtmClient::class));
        return $config;
    }

    public function getBaseData(): Saga {
        $config = $this->getConfig();
        $msg    = new Saga($config);
        $req    = new BusiReq([
            'Amount'         => 30,
            'TransOutResult' => 'SUCCESS',
            'TransInResult'  => 'SUCCESS',
        ]);
        $svc    = Constants::DTM_BUS_GRPC_SERVER;
        $msg->addSteps($svc . '/examples.Busi/TransOut', $svc . '/examples.Busi/TransOutRevert', $req);
        $msg->addSteps($svc . '/examples.Busi/TransIn', $svc . '/examples.Busi/TransInRevert', $req);
        return $msg;
    }

    public function testSubmit() {
        $msg = $this->getBaseData();
        $msg->submit();
    }

    public function testSubmitFunc() {
        $svc   = Constants::DTM_BUS_GRPC_SERVER;
        $req   = new BusiReq([
            'Amount'         => 30,
            'TransOutResult' => 'SUCCESS',
            'TransInResult'  => 'SUCCESS',
        ]);
        $steps = [
            [
                'action'     => $svc . '/examples.Busi/TransOut',
                'compensate' => $svc . '/examples.Busi/TransOutRevert',
                'data'       => $req
            ],
            [
                'action'     => $svc . '/examples.Busi/TransIn',
                'compensate' => $svc . '/examples.Busi/TransInRevert',
                'data'       => $req
            ]
        ];
        \DtmGrpc\sagaGlobalTransaction(Constants::DTM_GRPC_SERVER, $steps);
    }
}