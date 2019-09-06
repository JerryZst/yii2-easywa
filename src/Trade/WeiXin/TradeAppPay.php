<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 17:02
 */

namespace easywa\wapay\Trade\WeiXin;


use easywa\wapay\Common\WeiXin\WxBaseHandle;
use easywa\wapay\Common\WeiXin\PayData\Trade\TradeAppData;
use easywa\wapay\Common\WeiXin\PayData\Back\BackAppData;

class TradeAppPay extends WxBaseHandle
{

    protected function getBuildDataClass()
    {
        // TODO: Implement getBuildDataClass() method.
        return TradeAppData::class;
    }

    protected function retData(array $ret)
    {
        $back = new BackAppData($this->config, $ret);

        $back->setSign();
        $backData = $back->getData();

        return $backData;
    }
}