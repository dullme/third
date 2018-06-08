<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowMoney extends Model
{
    protected $connection = 'mysql_pu_hui';
    protected $table = "hc_borrow_money";

    public function loanPlan() {
        return $this->belongsTo(LoanPlan::class, 'id', 'pay_id')
            ->select(['pay_id', 'term', 'agreement_id']);
    }
}
