<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomOptionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_options', function (Blueprint $table) {
            DB::statement('INSERT INTO `custom_options` (`option_name`, `value`, `created_at`, `updated_at`) VALUES
(\'main_page_content_block\', \'<p>Content block for main page</p>\', NULL, NULL),
(\'main_page_product_block_title\', \'Modetøj: Kæmpe udvalg222\', NULL, \'2017-02-24 10:30:23\'),
(\'referal_link_prefix\', \'http://www.partner-ads.com/dk/klikbanner.php?partnerid=22253&bannerid=42829&htmlurl=\', NULL, \'2017-02-24 09:58:25\');');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
