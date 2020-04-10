<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('khach_hang_id');
            $table->string('tong_tien');
            $table->unsignedInteger('create_by');
            $table->timestamps();

            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
            $table->foreign('create_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa_don');
    }
}
