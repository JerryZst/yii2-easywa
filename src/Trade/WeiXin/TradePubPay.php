<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 16:55
 */

namespace easywa\wapay\Trade\WeiXin;

use easywa\wapay\Common\WeiXin\WxBaseHandle;
use easywa\wapay\Common\WeiXin\PayData\Trade\TradePublicData;
use easywa\wapay\Common\WeiXin\PayData\Back\BackPublicData;
use yii\helpers\BaseJson;

class TradePubPay extends WxBaseHandle
{
    protected function getBuildDataClass()
    {
        // TODO: Implement getBuildDataClass() method.
        return TradePublicData::class;
    }

    protected function retData(array $ret)
    {
        $back = new BackPublicData($this->config, $ret);
        $back->setSign();
        $backData = $back->getData();

        $backData['paySign'] = $backData['sign'];
        // 移除sign
        unset($backData['sign']);

        return BaseJson::encode($backData);
    }
}