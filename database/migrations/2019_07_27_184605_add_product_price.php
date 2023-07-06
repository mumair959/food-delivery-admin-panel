<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('net_price')->after('product_img_url');
            $table->bigInteger('vendor_price')->default(0)->after('product_img_url');
            $table->bigInteger('referal_percentage')->default(0)->after('product_img_url');   
            $table->bigInteger('discount')->after('product_img_url');
            $table->bigInteger('price')->after('product_img_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
