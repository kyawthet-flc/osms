<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('shop_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');

            $table->string('coordinates')->nullable();
            $table->tinyInteger('div_id')->nullable();
            $table->tinyInteger('dis_id')->nullable();
            $table->tinyInteger('ts_id')->nullable(); 
            $table->mediumText('address')->nullable();
            $table->mediumText('desc')->nullable();         

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
        Schema::dropIfExists('customers');
    }
}
