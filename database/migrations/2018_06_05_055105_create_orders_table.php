<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->string('order_no')->unique()->comment('订单编号');
            $table->integer('status')->comment('订单状态 0:未支付，10:支付成功');
            $table->integer('amount')->default(0)->comment('订单总金额 100 比 1');
            $table->integer('price')->default(0)->comment('用户实际到账  100 比 1');
            $table->integer('fee')->default(0)->comment('手续费 100 比 1');
            $table->string('recharge_rate')->nullable()->comment('充值费率');
            $table->string('transaction_no')->nullable()->comment('支付渠道返回的交易流水号，支付宝返回转账记录订单号');
            $table->string('channel_type')->nullable()->comment('充值渠道');
            $table->string('remark')->nullable()->comment('订单备注信息');
            $table->timestamp('completed')->nullable()->comment('订单完成时间');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
