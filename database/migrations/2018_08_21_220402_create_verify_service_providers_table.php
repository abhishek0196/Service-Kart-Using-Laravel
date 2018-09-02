<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifyServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_service_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serviceprovider_id')->unsigned();
            $table->foreign('serviceprovider_id')->references('id')->on('serviceproviders')->onDelete('cascade');
            $table->string('token');
            $table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verfiy_service_providers');
    }
}
