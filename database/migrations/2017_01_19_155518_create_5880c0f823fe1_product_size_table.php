<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5880c0f823fe1ProductSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('product_size')) {
            Schema::create('product_size', function (Blueprint $table) {
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_8674_8664_size_product')->references('id')->on('products');
                $table->integer('size_id')->unsigned()->nullable();
                $table->foreign('size_id', 'fk_p_8664_8674_product_size')->references('id')->on('sizes');
                
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
        Schema::dropIfExists('product_size');
    }
}
