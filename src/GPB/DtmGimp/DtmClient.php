<?php
// GENERATED CODE -- DO NOT EDIT!

namespace DtmGrpc\GPB\DtmGimp;

/**
 * The dtm service definition.
 */
class DtmClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Google\Protobuf\GPBEmpty $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function NewGid(\Google\Protobuf\GPBEmpty $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dtmgimp.Dtm/NewGid',
        $argument,
        ['\DtmGrpc\GPB\DtmGimp\DtmGidReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\GPB\DtmGimp\DtmRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Submit(\DtmGrpc\GPB\DtmGimp\DtmRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dtmgimp.Dtm/Submit',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\GPB\DtmGimp\DtmRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Prepare(\DtmGrpc\GPB\DtmGimp\DtmRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dtmgimp.Dtm/Prepare',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\GPB\DtmGimp\DtmRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Abort(\DtmGrpc\GPB\DtmGimp\DtmRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dtmgimp.Dtm/Abort',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \DtmGrpc\GPB\DtmGimp\DtmBranchRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function RegisterBranch(\DtmGrpc\GPB\DtmGimp\DtmBranchRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/dtmgimp.Dtm/RegisterBranch',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
