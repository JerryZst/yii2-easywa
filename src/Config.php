<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 14:34
 */

namespace easywa\wapay;


final class Config
{
    const VERSION = '1.0.0';


    /**
     *  微信支付
     */
    const WEIXIN = 'wx';

    // 微信退款单查询
    const WEIXIN_REFUND = 'refund';

    // 微信企业付款查询
    const WEIXIN_TRANS = 'transfer';

    // 微信公众账号 扫码支付  主要用于pc站点
    const WX_CHANNEL_QR = 'wx_web';

    // 微信 公众账号 支付
    const WX_CHANNEL_PUB = 'wx_pub';

    // 微信 APP 支付
    const WX_CHANNEL_APP = 'wx_app';

    // 微信 h5 支付
    const WX_CHANNEL_MWEB = 'wx_mweb';

    // 支付的最小金额
    const PAY_MIN_FEE = '0.01';

    // 支付的最大金额
    const PAY_MAX_FEE = '100000.00';

    // 交易状态常量定义
    // 交易成功
    const TRADE_STATUS_SUCC = 'success';

    // 交易未完成
    const TRADE_STATUS_FAILD = 'not_pay';

    // 交易退款成功
    const TRADE_STATUS_REFUND_SUCC = 'refund_succ';

    // 通知类型
    // 支付的交易通知
    const TRADE_NOTIFY = 'trade';

    // 退款的通知
    const REFUND_NOTIFY = 'refund';

    // 转账的通知
    const TRANSFER_NOTIFY = 'transfer';
}