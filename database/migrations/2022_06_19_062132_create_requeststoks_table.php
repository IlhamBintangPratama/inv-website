<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequeststoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requeststoks', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('idbarang');
            $table->integer('idjenis');
            $table->float('jumlah');
            $table->date('tanggal');
            $table->integer('waktu_pemesanan');
            $table->integer('frekuensi');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('requeststoks');
    }
}
