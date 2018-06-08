<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DebtApply extends Model
{
    protected $connection = 'mysql_pu_hui';
    protected $table = "hc_third_party_intention";

    public function borrowMoney() {
        return $this->hasMany(BorrowMoney::class, 'agreement_id', 'agreement_id')
            ->with('loanPlan')
            ->select(['id','online_status', 'agreement_id', 'actual_amount', 'plan_date']);
    }

    public function borrowMoneyWithPlan() {
        return $this->hasMany(BorrowMoney::class, 'agreement_id', 'agreement_id')
            ->where('online_status','!=', 3)
            ->select(['id','online_status', 'agreement_id', 'actual_amount', 'plan_date']);
    }

    public function agreement() {
        return $this->belongsTo(Agreement::class, 'agreement_id', 'id')
            ->select(['id','month_rate']);
    }
}
