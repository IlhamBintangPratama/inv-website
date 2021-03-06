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
            $table->integer('id_barang')->unsigned();
            $table->integer('id_jenis')->unsigned();
            $table->string('awal');
            $table->string('stok_masuk')->default(0)->nullable();
            $table->string('stok_keluar')->default(0)->nullable();
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
