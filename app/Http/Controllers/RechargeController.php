<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class RechargeController extends Controller
{

    public function showRechargePage() {
        return view('recharge.recharge');
    }

    public function recharge(Request $request) {
        $this->validate($request, [
            'amount' => 'required|integer'
        ]);

        $orderNo = rand(1000000000, 9999999999);

        $order = Order::create([
            'user_id' => Auth()->user()->id,
            'order_no' => $orderNo,
            'status' => 0,
            'amount' => $request->get('amount') * 100,
        ]);

        $billing = app('App\Billing\BillingInterface');
        $data =  $billing->charge([
            'requestNo' => $order['order_no'],
            'userNo' => Auth()->user()->xj_user_id,
            'chargeAmt' => $order['amount'] / 100,
            'expectPayCompany' => 'LIANLIAN',
            'purpose' => 'compensatory',
            'timestamp' => time()
        ]);

        return view('pay', compact('data'));
    }

    public function callBack(Request $request) {
        $billing = app('App\Billing\BillingInterface');
        $result = $billing->callBack($request->all());

        return view('account.back', compact('result'));
    }
}
