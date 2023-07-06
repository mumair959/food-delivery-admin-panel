<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('payment_method_id');      
            $table->bigInteger('total_amount');      
            $table->string('payment_status');
            $table->string('invoice_num');
            $table->string('invoice_link');            
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');            
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
