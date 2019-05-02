<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinalDropRtiStatusIdRtiFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_form', function (Blueprint $table) {
            $table->dropForeign(['rti_status_id']);
            $table->dropColumn('rti_status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rti_form', function (Blueprint $table) {
            $table->integer('rti_status_id');
        });
    }
}
