<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
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
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('street');
            $table->string('city');
            $table->char('zip', 5);
            $table->unsignedInteger('country_id');
            $table->unsignedBigInteger('phone')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->datetime('order_date_time');
            $table->string('order_hash');
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
