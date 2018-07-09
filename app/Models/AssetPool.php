<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetPool extends Model
{
    protected $connection = 'mysql_pu_hui';
    protected $table = "hc_asset_pool";

    public function member() {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}