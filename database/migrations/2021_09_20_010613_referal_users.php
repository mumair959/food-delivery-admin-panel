<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferalUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referal_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referal_code');
            $table->bigInteger('refered_to_id');
            $table->bigInteger('refered_by_id');
            $table->timestamps();

            $table->foreign('refered_to_id')->references('id')->on('users');
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
