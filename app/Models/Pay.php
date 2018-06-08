<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'subject',
        'order_no',
        'paid',
        'channel',
        'transaction_no',
        'amount',
    ];
}
