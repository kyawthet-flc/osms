<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constraint();
            $table->integer('sub_sku')->nullable();

            $table->string('color')->nullable();
            $table->string('size')->nullable();

            $table->tinyInteger('quantity_bought')->nullable();
            $table->tinyInteger('quantity_avaiable');
            $table->tinyInteger('quantity_left');
            $table->string('unit')->nullable();
            
            $table->integer('price_bought');
            $table->integer('price_original');
            $table->integer('price_sold');
            $table->integer('currency');
            $table->enum('is_sold_out', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('sub_products');
    }
}
