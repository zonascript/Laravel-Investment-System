<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paypal_name');
            $table->string('paypal_image');
            $table->string('paypal_rate',15);
            $table->string('paypal_min',15);
            $table->string('paypal_max',15);
            $table->string('paypal_fix',15);
            $table->string('paypal_percent',15);
            $table->string('paypal_email');
            $table->tinyInteger('paypal_status');
            $table->string('perfect_name');
            $table->string('perfect_image');
            $table->string('perfect_rate',15);
            $table->string('perfect_min',15);
            $table->string('perfect_max',15);
            $table->string('perfect_fix',15);
            $table->string('perfect_percent',15);
            $table->string('perfect_account');
            $table->string('perfect_alternate');
            $table->tinyInteger('perfect_status');
            $table->string('btc_name');
            $table->string('btc_image');
            $table->string('btc_rate',15);
            $table->string('btc_min',15);
            $table->string('btc_max',15);
            $table->string('btc_fix',15);
            $table->string('btc_percent',15);
            $table->string('btc_api');
            $table->string('btc_xpub');
            $table->tinyInteger('btc_status');
            $table->string('stripe_name');
            $table->string('stripe_image');
            $table->string('stripe_rate',15);
            $table->string('stripe_min',15);
            $table->string('stripe_max',15);
            $table->string('stripe_fix',15);
            $table->string('stripe_percent',15);
            $table->string('stripe_secret');
            $table->string('stripe_publishable');
            $table->tinyInteger('stripe_status');
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
        Schema::dropIfExists('payments');
    }
}
