<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->enum('status', ['pending', 'approved','inprogress','completed','cancelled'])->default('pending');
            $table->integer('customer-id')->unsigned();
            $table->foreign('customer-id')->references('id')->on('customers')->onDelete('cascade');;
            $table->integer('serviceprovider-id')->unsigned();
            $table->foreign('serviceprovider-id')->references('id')->on('serviceproviders')->onDelete('cascade');;
            $table->integer('service-id')->unsigned();
            $table->foreign('service-id')->references('id')->on('products')->onDelete('cascade');;
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

