<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_8660_categorycategory_product')->references('id')->on('categories');
                $table->string('source_url');
                $table->string('name');
                $table->string('sku')->nullable();
                $table->double('old_price', 15, 2)->nullable();
                $table->double('new_price', 15, 2)->nullable();
                $table->double('regular_price', 15, 2)->nullable();
                $table->text('description')->nullable();
                $table->text('first_accordion_content')->nullable();
                $table->text('second_accordion_content')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('products');
    }
}
