<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableCthd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cthd', function (Blueprint $table) {
            //
            $table->integer('giam_gia')->default(0);
            $table->string('don_gia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cthd', function (Blueprint $table) {
            //
            $table->dropColumn('giam_gia');
            $table->dropColumn('don_gia');
        });
    }
}
