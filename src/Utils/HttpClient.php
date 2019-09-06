<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/8/30 0030
 * Time: 19:24
 */

namespace easywa\wapay\Utils;

use Yii;
use yii\base\Component;
use yii\helpers\BaseJson;
use yii\httpclient\Client;
use yii\httpclient\CurlTransport;

class HttpClient extends Component
{
    private $_httpClient;

    public function getHttpClient()
    {
        if ($this->_httpClient === null) {
            $this->_httpClient = \Yii::createObject([
                'class' => Client::className(),
                'transport' => CurlTransport::className()
            ]);
        }
        return $this->_httpClient;
    }

    /**
     * Notes:
     * @Description:发送get请求
     * @Author: jerryzst
     * @Date: 2019/8/30 0030
     * @Time: 19:27
     * @param $url
     * @param null $data
     * @return mixed
     */
    public function httpGet($url, $data = null)
    {
        $request = $this->getHttpClient()->get($url, $data);
        return $this->sendHttp($request);
    }

    /**
     * Notes:
     * @Description: 发送post请求
     * @Author: jerryzst
     * @Date: 2019/8/30 0030
     * @Time: 19:27
     * @param $url
     * @param null $data
     * @param bool $isEncode
     * @return mixed
     */
    public function httpPost($url, $data = null, $isEncode = false)
    {
        if ($isEncode && is_array($data)) {
            $data = BaseJson::encode($data);
        }
        $request = $this->getHttpClient()->post($url, $data);
        return $this->sendHttp($request);
    }

    private function sendHttp($request)
    {
        return $request->send()->getContent();
    }
}