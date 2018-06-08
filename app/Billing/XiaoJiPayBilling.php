<?php

namespace App\Billing;

use App\Tools\XiaoJiKeji;
use Carbon\Carbon;

class XiaoJiPayBilling implements BillingInterface {

    protected $redirectUrl;

    /**
     * XiaoJiPayBilling constructor.
     */
    public function __construct() {
        $this->redirectUrl = config('xiaoji.redirectUrl');
    }

    public function charge(array $data) {
        $data['redirectUrl'] = $this->redirectUrl;
        $xiaoJiKeJi = new XiaoJiKeji();
        $options = $xiaoJiKeJi->makeOptions('RECHARGE', $data);
        
        return $options;
    }

    public function notify(){

    }

    public function callBack(array $data){
        $res = json_decode($data['respData'], true);
        if(is_array($res) && $res['resultCode'] == '0000'){
            return [
                'status' => true,
                'message' => '操作成功',
            ];
        }

        return [
            'status' => false,
            'message' => '操作失败',
        ];
    }

    public function applyWithdraw(array $data){

    }

    public function applyWithdrawNotify(){

    }

    public function getBankCode($bank_name){

    }
}