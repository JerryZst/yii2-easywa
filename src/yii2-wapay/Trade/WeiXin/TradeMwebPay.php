<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 17:04
 */

namespace easywa\wapay\Trade\WeiXin;


use easywa\wapay\Common\WeiXin\WxBaseHandle;
use easywa\wapay\Common\WeiXin\PayData\Trade\TradeMwebData;
use easywa\wapay\Common\WeiXin\PayData\Back\BackMwebData;

class TradeMwebPay extends WxBaseHandle
{
    protected function getBuildDataClass()
    {
        // TODO: Implement getBuildDataClass() method.
        return TradeMwebData::class;
    }

    protected function retData(array $ret)
    {
        $back = new BackMwebData($this->config, $ret);
        $back->setSign();
        $backData = $back->getData();
        return $backData;
    }
}