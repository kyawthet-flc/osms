<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('name_mm')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo')->nullable();
            $table->enum('online',['yes', 'no'])->default('yes')->nullable();
            $table->string('coordinates')->nullable();
            $table->tinyInteger('div_id')->nullable();
            $table->integer('dis_id')->nullable();
            $table->integer('ts_id')->nullable();
            $table->mediumText('address')->nullable();
            $table->mediumText('desc')->nullable();
            $table->enum('status',['active', 'inactive', 'deleted'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
