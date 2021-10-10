<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('shop_id')->constraint();
            $table->unsignedBigInteger('product_type_id');
            $table->string('sku')->nullable();
            $table->integer('sku_serial')->nullable();
            $table->string('name');
            $table->enum('status', ['draft', 'on_sale', 'inactive', 'deleted'])->default('on_sale');
            $table->mediumText('desc')->nullable();
            $table->datetime('selling_at')->nullable();
            $table->integer('total_sub_product')->default(0)->nullable();
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
        Schema::dropIfExists('products');
    }
}
