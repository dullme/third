<?php

namespace App\Http\Controllers;

use App\Models\DebtApply;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDebtPage(Request $request) {
        $params = $request->all();
        $debts = DebtApply::with('borrowMoney')
            ->with('agreement')
            ->where(function ($query) use ($params){
            if(!empty($params['name'])) {
                $query->whereName($params['name']);
            }
            if(!empty($params['mobile'])) {
                $query->whereMobile($params['mobile']);
            }
            if(!empty($params['id_card'])) {
                $query->whereIdCard($params['id_card']);
            }
            if(!empty($params['status'])) {
                $query->whereStatus($params['status']);
            }
            if(!empty($params['start']) && !empty($params['end'])) {
                $query->whereBetween('create_time', [$params['start'], $params['end']]);
            }
        })->orderBy('create_time', 'DESC')->paginate(5);

        $collection = collect($debts->items())->map(function ($debt) {
            $debt['repayment_list'] = $debt['borrowMoney']->map(function($item){
                $item['term'] = $item->loanPlan->term;
                unset($item['loanPlan']);
                return $item;
            });
            $month_rate = isset($debt->agreement->month_rate)?$debt->agreement->month_rate:0;
            $debt['month_rate'] = $month_rate * 12;
            unset($debt['agreement']);
            unset($debt['borrowMoney']);
            return $debt;
        });

        return view('debt.debt', compact('debts', 'collection', 'request'));
    }

    public function detail($id) {
        $debt = DebtApply::findOrFail($id);

        return view('debt.detail', compact('debt'));
    }

    public function plan($id) {
        return view('debt.plan');
    }


}
