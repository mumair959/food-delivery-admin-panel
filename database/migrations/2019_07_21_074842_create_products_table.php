<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('is_active',['0','1']);
            $table->string('variant_1')->nullable();
            $table->string('variant_2')->nullable();
            $table->string('variant_3')->nullable();      
            $table->enum('is_composite',['0','1']);
            $table->enum('has_variants',['0','1']);   
            $table->string('product_img_url')->nullable();
            $table->bigInteger('vendor_id');
            $table->bigInteger('food_id');   
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('food_id')->references('id')->on('food_types');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
