<?php

namespace App\Http\Controllers;

use App\Models\DebtApply;
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
        $debts = DebtApply::all();
        $count = $debts->count();
        $money = $debts->sum('borrow_money');

        return view('home', compact('count', 'money'));
    }
}
