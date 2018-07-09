<?php

namespace App\Tools;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class XiaoJiKeji {
    protected $directUrl;
    protected $gatewayUrl;
    protected $platform;
    protected $privateKey;
    protected $publicKey;

    /**
     * XiaoJiKeji constructor.
     */
    public function __construct() {
        $this->directUrl = config('xiaoji.directUrl');
        $this->gatewayUrl = config('xiaoji.gatewayUrl');
        $this->platform = config('xiaoji.platform');
        $this->privateKey = config('xiaoji.privateKey');
        $this->publicKey = config('xiaoji.publicKey');
    }

    /**
     * 发起请求
     * @param $serviceName
     * @param $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function postXiaoJi($serviceName, $data){
        $client = new Client();
        try {
            return $client->request('POST', $this->directUrl, [
                'form_params' => $this->makeOptions($serviceName, $data)
            ]);
        } catch (RequestException $e) {
            return abort($e->getCode());
        }
    }

    /**
     * 生产请求参数
     * @param $serviceName
     * @param $data
     * @return array
     */
    public function makeOptions($serviceName, $data) {
        $timestamp = time();
        if(is_array($data)){
            $data['timestamp'] = $timestamp;
            $data = json_encode($data);
        }

        return [
            'sign' => $this->rsaSign($data),
            'reqData' => $data,
            'serviceName' => $serviceName,
            'platform' => $this->platform,
            'timestamp' => $timestamp,
        ];
    }

    public function getRespData($request) {

        return json_decode(json_decode($request, true)['respData'],true);
    }

    /**
     * 获取账户余额
     * @param $userNo
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBalance($userNo) {
        $res = $this->postXiaoJi('QUERY_USER_ACCOUNT', [
            'requestNo' => time().rand(100000,999999),
            'userNo' => $userNo,
        ]);
	
	if(is_null($res) || $this->getRespData($res->getBody())['resultCode'] != 0000){
            return 0;
        }

        return $this->getRespData($res->getBody())['balance'];
    }

    /**
     * 获取充值流水
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRechargeHistory($data) {
        $res = $this->postXiaoJi('QUERY_RECHARGE_HISTORY', $data);
        
	    if(is_null($res) || $this->getRespData($res->getBody()->getContents())['resultCode'] != 0000){
            return [];
        }

        return [
            'data' => $this->getRespData($res->getBody()->getContents())['rechargeHistory'],
            'page' => $this->getRespData($res->getBody()->getContents())['page'],
        ];
    }

    /**
     * RSA 加签
     * @param $data
     * @return string
     */
    public function rsaSign($data) {
        //转换为openssl密钥，必须是没有经过pkcs8转换的私钥
        $res = openssl_get_privatekey($this->privateKey);

        //调用openssl内置签名方法，生成签名$sign
        openssl_sign($data, $sign, $res,OPENSSL_ALGO_SHA1);

        //释放资源
        openssl_free_key($res);

        //base64编码
        $sign = base64_encode($sign);

        return $sign;
    }

    /**
     * RSA验签
     * @param $data
     * @param $sign
     * @return bool
     */
    public function verify($data, $sign) {
        //转换为openssl格式密钥
        $res = openssl_get_publickey($this->publicKey);

        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($data, base64_decode($sign), $res,OPENSSL_ALGO_SHA1);

        //释放资源
        openssl_free_key($res);

        //返回资源是否成功
        return $result;
    }
}
