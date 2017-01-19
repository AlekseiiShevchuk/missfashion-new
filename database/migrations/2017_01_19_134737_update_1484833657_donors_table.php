<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1484833657DonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_8660_categorycategory_donor')->references('id')->on('categories');
                
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->dropForeign('fk_8660_category_category_id_donor');
            $table->dropIndex('fk_8660_category_category_id_donor');
            $table->dropColumn('category_id');
            
        });

    }
}
