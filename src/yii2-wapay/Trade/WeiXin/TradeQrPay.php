<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 17:08
 */

namespace easywa\wapay\Trade\WeiXin;

use easywa\wapay\Common\WeiXin\PayData\Trade\TradeQrData;
use easywa\wapay\Common\WeiXin\WxBaseHandle;

class TradeQrPay extends WxBaseHandle
{
    protected function getBuildDataClass()
    {
        // TODO: Implement getBuildDataClass() method.
        return TradeQrData::class;
    }

    protected function retData(array $ret)
    {
        return $ret['code_url'];
    }
}