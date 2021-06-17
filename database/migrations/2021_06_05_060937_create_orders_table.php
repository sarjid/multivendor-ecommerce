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
            $table->unsignedBigInteger('user_id');
            $table->string('order_number',10)->unique();
            $table->float('sub_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('coupon')->default(0)->nullable();
            $table->string('payment_method')->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('condition',['pending','processing','delivered','cancelled'])->default('pending');
            $table->float('delivery_charge')->default(0)->nullable();
            $table->integer('quantity')->default(0);

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postcode')->nullable();
            $table->mediumText('note')->nullable();

            $table->string('sfirst_name');
            $table->string('slast_name');
            $table->string('semail')->nullable();
            $table->string('sphone');
            $table->string('scountry')->nullable();
            $table->string('saddress')->nullable();
            $table->string('scity');
            $table->string('sstate');
            $table->string('spostcode')->nullable();
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
