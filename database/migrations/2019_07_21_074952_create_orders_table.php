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
            $table->bigIncrements('id');
            $table->bigInteger('tracking_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('vendor_id');      
            $table->bigInteger('amount');
            $table->string('discount_type');
            $table->bigInteger('discount');
            $table->bigInteger('admin_comission');
            $table->bigInteger('net_amount');
            $table->string('payment_status');
            $table->string('wallet_redeem');
            $table->bigInteger('order_deliver_address');
            $table->timestamps();

            $table->foreign('tracking_id')->references('id')->on('order_tracks');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('vendor_id')->references('id')->on('vendors');
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
