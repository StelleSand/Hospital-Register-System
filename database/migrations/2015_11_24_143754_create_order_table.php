<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctor');
            $table->dateTime('order_date');
            $table->dateTime('pay_date');
            $table->enum('state',array('ordered','order_canceled','payed','payment_canceled','triage_checked','doctor_checked','completed'))->default('ordered');
            $table->double('price');
            $table->double('refund')->default(0);//退款
            $table->dateTime('appoint_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('order');
    }
}
