<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->string('sku');
            $table->string('variant_val_1')->nullable();
            $table->string('variant_val_2')->nullable();
            $table->string('variant_val_3')->nullable();  
            $table->bigInteger('vendor_price')->default(0);  
            $table->bigInteger('referal_percentage')->default(0);                
            $table->bigInteger('price');
            $table->string('discount_type');
            $table->bigInteger('discount');
            $table->bigInteger('net_price');
            $table->bigInteger('quantity');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
