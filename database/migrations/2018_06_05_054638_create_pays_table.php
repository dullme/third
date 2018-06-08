<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->integer('order_id')->comment('用户订单id');
            $table->string('subject')->comment('商品标题');
            $table->string('order_no')->comment('商户订单号');
            $table->tinyInteger('paid')->comment('是否已付款');
            $table->string('channel')->comment('支付使用的第三方支付渠道');
            $table->string('transaction_no')->comment('支付渠道返回的交易流水号');
            $table->integer('amount')->comment('订单总金额');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
