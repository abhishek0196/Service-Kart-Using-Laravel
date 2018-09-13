<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b5cbcd7a48d3ProductProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('product_product_tag')) {
            Schema::create('product_product_tag', function (Blueprint $table) {
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_189510_189509_produc_5b5cbcd7a49d9')->references('id')->on('products')->onDelete('cascade');
                $table->integer('product_tag_id')->unsigned()->nullable();
                $table->foreign('product_tag_id', 'fk_p_189509_189510_produc_5b5cbcd7a4a6a')->references('id')->on('product_tags')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_product_tag');
    }
}
