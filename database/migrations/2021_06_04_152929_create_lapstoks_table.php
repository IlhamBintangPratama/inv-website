<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapstoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapstoks', function (Blueprint $table) {
            $table->increments('id', true);
            $table->date('tanggal');
            $table->integer('items_id')->unsigned();
            $table->integer('types_id')->unsigned();
            $table->string('awal');
            $table->string('masuk');
            $table->string('keluar');
            $table->string('akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lapstoks');
    }
}
