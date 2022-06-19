<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilmetodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasilmetodes', function (Blueprint $table) {
            $table->increments('id', true);
            $table->date('tanggal');
            $table->integer('barang_id');
            $table->integer('jenis_id');
            $table->integer('periode');
            $table->integer('permintaan');
            $table->float('eoq');
            $table->integer('frekuensi');
            $table->integer('leadtime');
            $table->float('rop')->nullable()->default(0);
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
        Schema::dropIfExists('hasilmetodes');
    }
}
