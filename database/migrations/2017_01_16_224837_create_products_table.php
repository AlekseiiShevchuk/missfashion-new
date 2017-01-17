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
                $table->foreign('category_id', 'fk_8327_categorycategory_product')->references('id')->on('categories');
                $table->string('from_site_url')->nullable();
                $table->string('source_url');
                $table->string('name')->nullable();
                $table->string('sku')->nullable();
                $table->integer('old_price')->nullable();
                $table->integer('new_price')->nullable();
                $table->integer('regular_price')->nullable();
                $table->string('sko_str')->nullable();
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
