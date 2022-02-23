<?php


namespace DtmGrpc\Tests;


use DtmGrpc\Client;
use DtmGrpc\Config\MsgConfig;
use DtmGrpc\GPB\DtmGimp\DtmClient;
use DtmGrpc\Msg;
use DtmGrpc\Tests\Examples\DtmGimp\BusiReq;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use function DtmGrpc\genGid;

class TestMsg extends TestCase
{
    public function getDb(): \PDO {
        return new \PDO('mysql:dbname=dtm_barrier;host=127.0.0.1;port=3306', 'root', '');
    }

    public function openTx() {
        $db = $this->getDb();
        $db->beginTransaction();
        return $db;
    }

    public function getLogger(): Logger {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('php://stdout', Logger::INFO));
        return $log;
    }

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
        $msg->addSteps($svc . '/busi.Busi/TransOut', $req);
        $msg->addSteps($svc . '/busi.Busi/TransIn', $req);
        $msg->setQueryPrepared($svc . '/busi.Busi/CanSubmit');
        return $msg;
    }

    public function testPrepared() {
        $msg = $this->getBaseData();
        $msg->prepare('');
    }

    public function testSubmit() {
        $msg = $this->getBaseData();
        $msg->prepare('');
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
                'action' => $svc . '/busi.Busi/TransOut',
                'data'   => $req
            ],
            [
                'action' => $svc . '/busi.Busi/TransIn',
                'data'   => $req
            ]
        ];
        $prepared = $svc . '/busi.Busi/CanSubmit';
        \DtmGrpc\msgGlobalTransaction(Constants::DTM_GRPC_SERVER, $steps, $prepared);
    }

    public function testM() {
        $bid = sprintf("%02d", 11);
        var_dump($bid);
    }

    /**
     * @throws \Throwable
     */
    public function testDoAndSubmitDb() {
        $msg = $this->getBaseData();
        $svc    = Constants::DTM_BUS_GRPC_SERVER;
        $msg->doAndSubmitDb($svc .'/busi.Busi/QueryPreparedB',$this->getDb(), function (){
          echo "local trans success";
//            throw new  \Exception(11);
        }, $this->getLogger());
    }
}