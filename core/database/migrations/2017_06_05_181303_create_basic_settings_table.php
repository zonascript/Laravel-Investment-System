<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->float('tax');
            $table->float('withdraw');
            $table->tinyInteger('withdraw_status');
            $table->float('reference');
            $table->string('reference_id');
            $table->tinyInteger('registration_status');
            $table->tinyInteger('verify_status');
            $table->tinyInteger('reCaptcha_status');
            $table->string('site_key');
            $table->string('secret_key');
            $table->string('currency');
            $table->string('symbol');
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
        Schema::dropIfExists('basic_settings');
    }
}
