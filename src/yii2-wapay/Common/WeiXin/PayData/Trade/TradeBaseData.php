<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 16:21
 */

namespace easywa\wapay\Common\WeiXin\PayData\Trade;

use easywa\wapay\PayException;
use easywa\wapay\Common\WeiXin\PayData\WxPayData;
use easywa\wapay\Config;

abstract class TradeBaseData extends WxPayData
{
    protected function checkDataParam()
    {
        // TODO: Implement checkDataParam() method.
        $orderNo = $this->order_no;
        $amount = $this->amount;
        $clientIp = $this->client_ip;
        $subject = $this->subject;
        $body = $this->body;

        if (empty($orderNo) || mb_strlen($orderNo) > 64) {
            throw new PayException('订单号不能为空，并且长度不能超过64位');
        }

        if (bccomp($amount, Config::PAY_MIN_FEE, 2) === -1) {
            throw new PayException('支付金额不能低于 ' . Config::PAY_MIN_FEE . ' 元');
        }
        if (bccomp($amount, Config::PAY_MAX_FEE, 2) === 1) {
            throw new PayException('支付金额不能大于 ' . Config::PAY_MAX_FEE . ' 元');
        }
        $this->amount = bcmul($amount, 100, 0);

        if (empty($clientIp) || !preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $clientIp)) {
            throw new PayException('IP 地址必须上传，并且以IPV4的格式');
        }

        if (empty($subject) || empty($body)) {
            throw new PayException('必须提供商品名称与商品描述');
        }
    }
}