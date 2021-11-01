<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSupplymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_supplyments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('supplier_id');
            $table->integer('paid_amount')->default(0);
            $table->integer('remaining_amount')->default(0);
            $table->integer('total_amount')->default(0);
            $table->date('supplied_at')->nullable(); 
            $table->mediumText('remark')->nullable(); 
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
        Schema::dropIfExists('product_supplyments');
    }
}
