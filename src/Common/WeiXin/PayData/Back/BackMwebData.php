<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 16:51
 */

namespace easywa\wapay\Common\WeiXin\PayData\Back;

use easywa\wapay\Common\WeiXin\PayData\WxPayData;
use easywa\wapay\PayException;

class BackMwebData extends WxPayData
{
    protected function checkDataParam()
    {
        // TODO: Implement checkDataParam() method.
    }

    protected function buildData()
    {
        // TODO: Implement buildData() method.
        $this->retData = [
            'appId' => $this->appId,
            'trade_type' => $this->trade_type,
            'prepay_id' => $this->prepay_id,
            'mweb_url' => $this->mweb_url
        ];
    }
}