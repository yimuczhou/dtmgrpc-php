<?php

namespace DtmGrpc;

/**
 * Class Constants
 * @package DtmGrpc
 */
class Constants
{
    const TRANS_TYPE_TCC = 'tcc';
    const TRANS_TYPE_SAGA = 'saga';
    const TRANS_TYPE_XA = 'xa';
    const TRANS_TYPE_MSG = 'msg';

    const ACTION_TYPE_TRY = 'try';
    const ACTION_TYPE_CONFIRM = 'confirm';
    const ACTION_TYPE_CANCEL = 'cancel';
    const ACTION_TYPE_COMPENSATE = 'compensate';
    const ACTION_TYPE_ACTION = 'action';
}