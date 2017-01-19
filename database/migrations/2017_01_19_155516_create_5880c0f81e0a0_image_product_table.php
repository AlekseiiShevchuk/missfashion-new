<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5880c0f81e0a0ImageProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('image_product')) {
            Schema::create('image_product', function (Blueprint $table) {
                $table->integer('image_id')->unsigned()->nullable();
                $table->foreign('image_id', 'fk_p_8662_8674_product_image')->references('id')->on('images');
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_8674_8662_image_product')->references('id')->on('products');
                
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
        Schema::dropIfExists('image_product');
    }
}
