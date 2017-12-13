<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRebeatLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rebeat_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('balance');
            $table->integer('deposit_id');
            $table->dateTime('made_time');
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
        Schema::dropIfExists('rebeat_logs');
    }
}
