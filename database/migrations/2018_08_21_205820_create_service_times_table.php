<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_times', function (Blueprint $table) {
            $table->integer('serviceproviders_id')->unsigned();;
            $table->foreign('serviceproviders_id')->references('id')->on('serviceproviders')->onDelete('cascade');;
            $table->string('start_time')->default("09:00");
            $table->string('end_time')->default("09:00");
            $table->string('day');
           // $table->enum('Day',['Monday','Tueday','Wednesday','Thursday','Friday','Saturday','Sunday'])->default('Sunday');
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
        Schema::dropIfExists('service_times');
    }
}