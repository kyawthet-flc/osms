<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('product_id');

            $table->dateTime('ordered_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->dateTime('paid_at')->nullable();
            
            $table->dateTime('total_amount')->nullable();
            $table->integer('total_discount')->nullable()->default(0);
            $table->enum('status',['orderd', 'delivered', 'received', 'done'])->nullable();

            $table->enum('paid_status',['unpaid', 'paid'])->default('unpaid');
            $table->tinyInteger('payment_type_id');

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
        Schema::dropIfExists('orders');
    }
}
