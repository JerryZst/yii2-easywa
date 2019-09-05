<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 15:06
 */
namespace easywa\wapay\Common\WeiXin;

use easywa\wapay\Common\BaseHandle;
use easywa\wapay\PayException;
use \easywa\wapay\Common\WxConfig;
use easywa\wapay\Utils\HttpClient;
use easywa\wapay\Utils\DataParser;
use easywa\wapay\Utils\ArrayUtil;

abstract class WxBaseHandle implements BaseHandle
{
    /**
     * @var 支付配置文件
     */
    protected $config;

    /**
     * @var 支付数据
     */
    protected $reqData;

    /**
     * @var 请求句柄
     */
    protected $http;


    public function __construct(array $config)
    {
        mb_internal_encoding("UTF-8");

        try {
            $this->config = new WxConfig($config);
        } catch (PayException $exception) {
            throw $exception;
        }
    }

    /**
     * 获取支付对应的数据完成类
     * @return BaseData
     * @author helei
     */
    abstract protected function getBuildDataClass();

    public function handle(array $data)
    {
        $buildClass = $this->getBuildDataClass();

        try {
            $this->reqData = new $buildClass($this->config, $data);
        } catch (PayException $e) {
            throw $e;
        }

        $this->reqData->setSign();
        $xml = DataParser::toXml($this->reqData->getData());
        $ret = $this->sendReq($xml);

        // 检查返回的数据是否被篡改
        $flag = $this->signVerify($ret);
        if (!$flag) {
            throw new PayException('微信返回数据被篡改。请检查网络是否安全！');
        }

        return $this->retData($ret);
    }

    /**
     * 处理微信的返回值并返回给客户端
     * @param array $ret
     * @return mixed
     * @author helei
     */
    protected function retData(array $ret)
    {
        return $ret;
    }

    protected function sendReq($xml)
    {
        $url = $this->getReqUrl();
        if (is_null($url)) {
            throw new PayException('目前不支持该接口。请联系开发者添加');
        }
        $responseTxt = $this->httpPost($xml, $url);
        // 格式化为数组
        $retData = \easywa\wapay\Utils\DataParser::toArray($responseTxt);
        if ($retData['return_code'] != 'SUCCESS') {
            throw new PayException('微信返回错误提示:' . $retData['return_msg']);
        }

        if ($retData['result_code'] != 'SUCCESS') {
            throw new PayException('微信返回错误提示:' . $retData['err_code_des']);
        }

        return $retData;
    }

    protected function httpPost($xml, $url)
    {
        $this->http = new HttpClient();
        return $this->http->httpPost($xml, $url);
    }

    protected function getReqUrl()
    {
        return WxConfig::UNIFIED_URL;
    }

    /**
     * 检查微信返回的数据是否被篡改过
     * @param array $retData
     * @return boolean
     * @author helei
     */
    protected function signVerify(array $retData)
    {
        $retSign = $retData['sign'];
        $values = ArrayUtil::removeKeys($retData, ['sign', 'sign_type']);

        $values = ArrayUtil::paraFilter($values);

        $values = ArrayUtil::arraySort($values);

        $signStr = ArrayUtil::createLinkstring($values);

        $signStr .= "&key=" . $this->config->md5Key;

        $string = md5($signStr);

        return strtoupper($string) === $retSign;
    }
}