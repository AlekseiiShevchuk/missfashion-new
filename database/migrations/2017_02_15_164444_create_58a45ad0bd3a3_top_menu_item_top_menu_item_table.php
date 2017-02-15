<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create58a45ad0bd3a3TopMenuItemTopMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('top_menu_item_top_menu_item')) {
            Schema::create('top_menu_item_top_menu_item', function (Blueprint $table) {
                $table->integer('top_menu_parent_item_id')->unsigned()->nullable();
                $table->foreign('top_menu_parent_item_id', 'fk_p_15164_15164_parent_top_menu')->references('id')->on('top_menu_items')->onDelete('cascade');
                $table->integer('top_menu_item_id')->unsigned()->nullable();
                $table->foreign('top_menu_item_id', 'fk_p_15164_15164_submenu_top_menu')->references('id')->on('top_menu_items')->onDelete('cascade');
                
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
        Schema::dropIfExists('top_menu_item_top_menu_item');
    }
}
