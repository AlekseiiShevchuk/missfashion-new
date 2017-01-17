<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create587d4dc6a73d9ProductSizeTable extends Migration
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
                $table->foreign('product_id', 'fk_p_8328_8326_size_product')->references('id')->on('products');
                $table->integer('size_id')->unsigned()->nullable();
                $table->foreign('size_id', 'fk_p_8326_8328_product_size')->references('id')->on('sizes');
                
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
