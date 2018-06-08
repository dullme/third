<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPlan extends Model
{
    protected $connection = 'mysql_pu_hui';
    protected $table = "hc_loan_plan";
}
