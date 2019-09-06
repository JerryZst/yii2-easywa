<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 16:45
 */

namespace easywa\wapay\Common\WeiXin\PayData\Trade;

use easywa\wapay\Utils\ArrayUtil;

class TradeMwebData extends TradeBaseData
{
    protected function buildData()
    {
        // TODO: Implement buildData() method.
        $signData = [
            // 基本数据
            'appid' => trim($this->appId),
            'mch_id' => trim($this->mchId),
            'nonce_str' => $this->nonceStr,
            'notify_url' => $this->notifyUrl,
            'time_start' => $this->timeStart,
            'time_expire' => $this->timeExpire,
            //'limit_pay' => 'no_credit',  // 指定不使用信用卡
            // 业务数据
            'body' => trim($this->body),
            'attach' => trim($this->extra_param),
            'out_trade_no' => trim($this->order_no),
            'total_fee' => $this->amount,
            'spbill_create_ip' => trim($this->client_ip),
            'trade_type' => 'MWEB', //设置APP支付
        ];

        // 移除数组中的空值
        $this->retData = ArrayUtil::paraFilter($signData);
    }
}