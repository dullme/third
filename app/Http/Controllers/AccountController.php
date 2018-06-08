<?php

namespace App\Http\Controllers;

use App\Models\DebtApply;
use App\Tools\XiaoJiKeji;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AccountController extends Controller {

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAccountPage(Request $request) {
        $xiaoJiKeJi = new XiaoJiKeji();

        try {
            $balance = $xiaoJiKeJi->getBalance(Auth()->user()->xj_user_id);
        } catch (GuzzleException $e) {
        }

        try {
            $rechargeHistory = $xiaoJiKeJi->getRechargeHistory([
                'requestNo'   => time() . rand(100000, 999999),
                'userNo'      => Auth()->user()->xj_user_id,
                'startTime'   => $request->get('startTime', ''),
                'endTime'     => $request->get('endTime', time()),
                'timestamp'   => time(),
                'rechargeWay' => $request->get('rechargeWay', ''), //充值 1 扣款 PROXY
                'epage' => 20,
                'page' => $request->get('page', 1),
            ]);
            if(isset($rechargeHistory['page']))
                array_merge(['currentPage' => $request->get('page', 1)], $rechargeHistory['page']);
        } catch (GuzzleException $e) {
        }

        $debt = DebtApply::where('status', 7)->get();
        $totalCount = count($debt);
        $totalBorrowMoney = $debt->sum('borrow_money');

        return view('account.account', compact('balance', 'totalCount', 'totalBorrowMoney', 'rechargeHistory'));
    }
}
