<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('application_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['admin', 'user']);
            $table->string('user_id');
            $table->ipAddress('ip')->nullable();

            $table->string('table_name');
            $table->string('table_id');

            $table->enum('action', ['created', 'updated', 'deleted']);
            $table->text('old_data')->nullable();
            $table->text('new_data')->nullable();
            $table->enum('status', ['unread', 'read', 'deletable'])->default('unread');

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
        Schema::dropIfExists('application_logs');
    }
}
