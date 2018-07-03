<?php

namespace App\Http\Controllers;

use App\Models\DebtApply;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debts = DebtApply::where('company', Auth()->user()->company)->get();
        $count = $debts->count();
        $money = $debts->sum('borrow_money');


        $debts = DebtApply::with(['borrowMoneyWithPlan' => function($query){
            $query->where('plan_date', Carbon::tomorrow());
        }])->where('agreement_id', '!=', NULL)
            ->where('company', Auth()->user()->company)
            ->whereIn('status', [7,8])
            ->select('id', 'agreement_id')->get();

        $debts = $debts->map(function ($debt){
            return $debt->borrowMoneyWithPlan->sum('actual_amount');
        });
        $total =  $debts->sum();

        return view('home', compact('count', 'money', 'total'));
    }
}
