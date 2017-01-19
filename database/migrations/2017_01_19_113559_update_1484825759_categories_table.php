<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1484825759CategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable();
                $table->foreign('parent_id', 'fk_8660_categoryparent_category')->references('id')->on('categories');
                
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('fk_8660_category_parent_id_category');
            $table->dropIndex('fk_8660_category_parent_id_category');
            $table->dropColumn('parent_id');
            
        });

    }
}
