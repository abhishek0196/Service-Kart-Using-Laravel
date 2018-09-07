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
            $table->enum('status', ['pending', 'approved','inprogress','completed','cancelled','rejected'])->default('pending');
            $table->integer('customer-id')->unsigned();
            $table->foreign('customer-id')->references('id')->on('customers')->onDelete('cascade');;
            $table->integer('serviceprovider-id')->unsigned();
            $table->foreign('serviceprovider-id')->references('id')->on('serviceproviders')->onDelete('cascade');;
            $table->integer('service-id')->unsigned();
            $table->foreign('service-id')->references('id')->on('products')->onDelete('cascade');;
            $table->string('google_code');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            //$table->timestamps();
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

