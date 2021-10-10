<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginoutLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginout_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('action_type',['logged_in', 'logged_out'])->default('logged_in');
            $table->string('counter_mark')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->mediumText('user_agent')->nullable();
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
        Schema::dropIfExists('loginout_logs');
    }
}
