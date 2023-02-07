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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('order_id')->nullable();
            $table->string('c_name')->nullable();
            $table->string('c_email')->nullable();
            $table->string('c_phone')->nullable();
            $table->string('c_country')->nullable();
            $table->string('c_address')->nullable();
            $table->string('c_zipcode')->nullable();
            $table->string('c_city')->nullable();
            $table->string('c_extra_phone')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('after_discount')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('shipping_charge')->nullable();
            $table->date('date')->nullable();
            $table->boolean('status')->default(0);
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
