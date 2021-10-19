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
            $table->foreignId('customer_id')->constrained();
            $table->string('code')->nullable();
            $table->string('code_serial')->nullable();
            $table->dateTime('ordered_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->dateTime('paid_at')->nullable();
            
            $table->integer('total_amount')->nullable();
            $table->integer('total_discount')->nullable();
            $table->integer('deli_fee')->nullable();
            $table->enum('status',['ordered', 'delivered', 'received', 'done'])->nullable();

            $table->enum('paid_status',['unpaid', 'paid'])->default('unpaid');
            $table->tinyInteger('payment_type_id')->nullable();

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
