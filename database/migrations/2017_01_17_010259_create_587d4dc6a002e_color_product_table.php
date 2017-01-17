<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create587d4dc6a002eColorProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('color_product')) {
            Schema::create('color_product', function (Blueprint $table) {
                $table->integer('color_id')->unsigned()->nullable();
                $table->foreign('color_id', 'fk_p_8325_8328_product_color')->references('id')->on('colors');
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_8328_8325_color_product')->references('id')->on('products');
                
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
        Schema::dropIfExists('color_product');
    }
}
