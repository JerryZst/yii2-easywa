<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 16:36
 */

namespace easywa\wapay\Common\WeiXin\PayData\Back;

use easywa\wapay\Common\WeiXin\PayData\WxPayData;
use easywa\wapay\PayException;

class BackAppData extends WxPayData
{
    protected function buildData()
    {
        // TODO: Implement buildData() method.
        $this->retData = [
            'appid' => $this->appId,
            'partnerid' => $this->mchId,
            'prepayid' => $this->prepay_id,
            'package' => 'Sign=WXPay',
            'noncestr' => $this->nonceStr,
            'timestamp' => time(),
        ];
    }
}