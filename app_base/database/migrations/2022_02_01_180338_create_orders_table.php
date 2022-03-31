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
            $table->increments('id');
            $table->string('order_no')->unique();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('email');
            $table->string('forename');
            $table->string('surname');
            $table->string('address1');
            $table->string('address2');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('phone');
            $table->string('name_on_card');
            $table->string('subtotal');
            $table->string('tax');
            $table->string('total');
            $table->string('payment_gateway')->default('stripe');
            $table->string('status')->default('Processing');;
            $table->boolean('shipped')->default(false);
            $table->string('error')->nullable();
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
