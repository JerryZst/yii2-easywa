<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 15:41
 */
namespace easywa\wapay\Common\WeiXin\PayData;

class WxPayData extends \easywa\wapay\Common\BaseData
{
    public function makeSign($signStr)
    {
        $sign = '';
        switch ($this->signType) {
            case 'MD5':
                $signStr .= '&key=' . $this->md5Key;
                $sign = strtoupper(md5($signStr));
                break;
            default :
                $sign = '';
        }

        return strtoupper($sign);
    }
}