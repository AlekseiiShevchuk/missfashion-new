<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create587d4efec5952CategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('category_product')) {
            Schema::create('category_product', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_8327_8328_product_category')->references('id')->on('categories');
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_8328_8327_category_product')->references('id')->on('products');
                
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
        Schema::dropIfExists('category_product');
    }
}
