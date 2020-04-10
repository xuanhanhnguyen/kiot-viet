<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhapKhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhap_kho', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('khach_hang_id');
            $table->unsignedInteger('san_pham_id');
            $table->integer('sl_nhap');
            $table->timestamps();

            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
            $table->foreign('san_pham_id')->references('id')->on('san_pham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhap_kho');
    }
}
