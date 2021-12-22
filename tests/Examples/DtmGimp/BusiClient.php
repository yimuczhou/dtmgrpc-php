<?php
// GENERATED CODE -- DO NOT EDIT!

namespace DtmGrpc\Tests\Examples\DtmGimp;

/**
 * The dtm service definition.
 */
class BusiClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CanSubmit(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/CanSubmit',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransIn(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransIn',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransOut(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransOut',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransInRevert(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransInRevert',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransOutRevert(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransOutRevert',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransInConfirm(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransInConfirm',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransOutConfirm(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransOutConfirm',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Google\Protobuf\GPBEmpty $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function XaNotify(\Google\Protobuf\GPBEmpty $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/XaNotify',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransInXa(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransInXa',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransOutXa(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransOutXa',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransInTcc(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransInTcc',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransOutTcc(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransOutTcc',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransInTccNested(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransInTccNested',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransInBSaga(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransInBSaga',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransOutBSaga(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransOutBSaga',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransInRevertBSaga(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransInRevertBSaga',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function TransOutRevertBSaga(\DtmGrpc\Tests\Examples\DtmGimp\BusiReq $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/tests.Busi/TransOutRevertBSaga',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
