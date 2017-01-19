<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5880a6553f598CategoryDonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('category_donor')) {
            Schema::create('category_donor', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_8660_8659_donor_category')->references('id')->on('categories');
                $table->integer('donor_id')->unsigned()->nullable();
                $table->foreign('donor_id', 'fk_p_8659_8660_category_donor')->references('id')->on('donors');
                
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
        Schema::dropIfExists('category_donor');
    }
}
