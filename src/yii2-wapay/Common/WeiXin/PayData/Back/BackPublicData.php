<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 16:39
 */

namespace easywa\wapay\Common\WeiXin\PayData\Back;

use easywa\wapay\Common\WeiXin\PayData\WxPayData;
use easywa\wapay\PayException;

class BackPublicData extends WxPayData
{
    protected function buildData()
    {
        // TODO: Implement buildData() method.
        $this->retData = [
            'appId' => $this->appId,
            'package' => 'prepay_id=' . $this->prepay_id,
            'nonceStr' => $this->nonceStr,
            'timeStamp' => time() . '',
            'signType' => 'MD5',
        ];
    }
}