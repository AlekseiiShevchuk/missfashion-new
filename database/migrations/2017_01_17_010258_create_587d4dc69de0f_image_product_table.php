<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create587d4dc69de0fImageProductTable extends Migration
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
                $table->foreign('image_id', 'fk_p_8324_8328_product_image')->references('id')->on('images');
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_8328_8324_image_product')->references('id')->on('products');
                
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
