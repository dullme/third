<?php

namespace App\Billing;

interface BillingInterface{

    /**
     * 返回支付请求发起参数
     * @param array $data
     * @return mixed
     */
	public function charge(array $data);

    /**
     * 支付成功后异步验证结果
     * @return mixed
     */
	public function notify();

    /**
     * 支付成功同步回调页面参数
     * @param array $data
     * @return mixed
     */
    public function callBack(array $data);

    /**
     * 返回余额转账请求发起参数
     * @param array $data
     * @return mixed
     */
    public function applyWithdraw(array $data);

    /**
     * 余额转账成功后异步验证结果
     * @return mixed
     */
    public function applyWithdrawNotify();

    /**
     * 获取银行代码
     * @param $bank_name
     * @return mixed
     */
    public function getBankCode($bank_name);

}