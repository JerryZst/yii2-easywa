<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 14:07
 */

namespace easywa\wapay\Utils;


class WxUtil
{
    private function createNoncestr()
    {
        return \Yii::$app->security->generateRandomString();
    }

    private function getSign($Obj)
    {
        $Parameters = [];
        foreach ($Obj as $k => $v) {
            if ($k == 'sign') continue;
            $Parameters[$k] = $v;
        }
        ksort($Parameters);
        $String = self::formatBizQueryParaMap($Parameters, false);
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . PAY_SECRET;
        //签名步骤三：MD5加密
        $String = md5($String);
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        return $result_;
    }

    ///作用：格式化参数，签名过程需要使用
    public static function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar;
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }
}