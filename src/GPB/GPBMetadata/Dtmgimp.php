<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dtmgimp.proto

namespace DtmGrpc\GPB\GPBMetadata;

class Dtmgimp
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Protobuf\GPBEmpty::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
dtmgimp.protodtmgimp"S
DtmTransOptions

WaitResult (
TimeoutToFail (
RetryInterval ("�

DtmRequest
Gid (	
	TransType (	.
TransOptions (2.dtmgimp.DtmTransOptions
CustomedData (	
BinPayloads (
QueryPrepared (	
Steps (	"
DtmGidReply
Gid (	"�
DtmBranchRequest
Gid (	
	TransType (	
BranchID (	

Op (	1
Data (2#.dtmgimp.DtmBranchRequest.DataEntry
BusiPayload (+
	DataEntry
key (	
value (	:82�
Dtm8
NewGid.google.protobuf.Empty.dtmgimp.DtmGidReply" 7
Submit.dtmgimp.DtmRequest.google.protobuf.Empty" 8
Prepare.dtmgimp.DtmRequest.google.protobuf.Empty" 6
Abort.dtmgimp.DtmRequest.google.protobuf.Empty" E
RegisterBranch.dtmgimp.DtmBranchRequest.google.protobuf.Empty" B;Z	./dtmgimp�DtmGrpc\\GPB\\DtmGimp�DtmGrpc\\GPB\\GPBMetadatabproto3'
        , true);

        static::$is_initialized = true;
    }
}

