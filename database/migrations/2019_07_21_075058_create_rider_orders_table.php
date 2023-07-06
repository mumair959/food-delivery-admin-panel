<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiderOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rider_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('order_id');      
            $table->timestamp('order_picked_at')->nullable();
            $table->timestamp('order_droped_at')->nullable();
            $table->enum('customer_rating',['0','1','2','3','4','5'])->nullable();
            $table->string('status');
            $table->string('comments')->nullable();
            $table->timestamps();

            $table->foreign('rider_id')->references('id')->on('riders');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_orders');
    }
}
