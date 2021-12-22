<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dtmgimp.proto

namespace DtmGrpc\GPB\DtmGimp;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * DtmRequest request sent to dtm server
 *
 * Generated from protobuf message <code>dtmgimp.DtmRequest</code>
 */
class DtmRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Gid = 1;</code>
     */
    protected $Gid = '';
    /**
     * Generated from protobuf field <code>string TransType = 2;</code>
     */
    protected $TransType = '';
    /**
     * Generated from protobuf field <code>.dtmgimp.DtmTransOptions TransOptions = 3;</code>
     */
    protected $TransOptions = null;
    /**
     * Generated from protobuf field <code>string CustomedData = 4;</code>
     */
    protected $CustomedData = '';
    /**
     * for MSG/SAGA branch payloads
     *
     * Generated from protobuf field <code>repeated bytes BinPayloads = 5;</code>
     */
    private $BinPayloads;
    /**
     * for MSG
     *
     * Generated from protobuf field <code>string QueryPrepared = 6;</code>
     */
    protected $QueryPrepared = '';
    /**
     * Generated from protobuf field <code>string Steps = 7;</code>
     */
    protected $Steps = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $Gid
     *     @type string $TransType
     *     @type \DtmGrpc\GPB\DtmGimp\DtmTransOptions $TransOptions
     *     @type string $CustomedData
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $BinPayloads
     *           for MSG/SAGA branch payloads
     *     @type string $QueryPrepared
     *           for MSG
     *     @type string $Steps
     * }
     */
    public function __construct($data = NULL) {
        \DtmGrpc\GPB\GPBMetadata\Dtmgimp::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string Gid = 1;</code>
     * @return string
     */
    public function getGid()
    {
        return $this->Gid;
    }

    /**
     * Generated from protobuf field <code>string Gid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setGid($var)
    {
        GPBUtil::checkString($var, True);
        $this->Gid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string TransType = 2;</code>
     * @return string
     */
    public function getTransType()
    {
        return $this->TransType;
    }

    /**
     * Generated from protobuf field <code>string TransType = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setTransType($var)
    {
        GPBUtil::checkString($var, True);
        $this->TransType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.dtmgimp.DtmTransOptions TransOptions = 3;</code>
     * @return \DtmGrpc\GPB\DtmGimp\DtmTransOptions|null
     */
    public function getTransOptions()
    {
        return $this->TransOptions;
    }

    public function hasTransOptions()
    {
        return isset($this->TransOptions);
    }

    public function clearTransOptions()
    {
        unset($this->TransOptions);
    }

    /**
     * Generated from protobuf field <code>.dtmgimp.DtmTransOptions TransOptions = 3;</code>
     * @param \DtmGrpc\GPB\DtmGimp\DtmTransOptions $var
     * @return $this
     */
    public function setTransOptions($var)
    {
        GPBUtil::checkMessage($var, \DtmGrpc\GPB\DtmGimp\DtmTransOptions::class);
        $this->TransOptions = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string CustomedData = 4;</code>
     * @return string
     */
    public function getCustomedData()
    {
        return $this->CustomedData;
    }

    /**
     * Generated from protobuf field <code>string CustomedData = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setCustomedData($var)
    {
        GPBUtil::checkString($var, True);
        $this->CustomedData = $var;

        return $this;
    }

    /**
     * for MSG/SAGA branch payloads
     *
     * Generated from protobuf field <code>repeated bytes BinPayloads = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getBinPayloads()
    {
        return $this->BinPayloads;
    }

    /**
     * for MSG/SAGA branch payloads
     *
     * Generated from protobuf field <code>repeated bytes BinPayloads = 5;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setBinPayloads($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::BYTES);
        $this->BinPayloads = $arr;

        return $this;
    }

    /**
     * for MSG
     *
     * Generated from protobuf field <code>string QueryPrepared = 6;</code>
     * @return string
     */
    public function getQueryPrepared()
    {
        return $this->QueryPrepared;
    }

    /**
     * for MSG
     *
     * Generated from protobuf field <code>string QueryPrepared = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setQueryPrepared($var)
    {
        GPBUtil::checkString($var, True);
        $this->QueryPrepared = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Steps = 7;</code>
     * @return string
     */
    public function getSteps()
    {
        return $this->Steps;
    }

    /**
     * Generated from protobuf field <code>string Steps = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setSteps($var)
    {
        GPBUtil::checkString($var, True);
        $this->Steps = $var;

        return $this;
    }

}

