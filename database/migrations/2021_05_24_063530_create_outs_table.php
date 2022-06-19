<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outs', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('id_bulan');
            $table->integer('id_brg');
            $table->integer('jns_id');
            $table->float('jumlah');
            $table->string('tanggal');
            $table->string('hrg_jual');
            $table->integer('stoks_id');
            $table->string('buyer');
            $table->integer('total');
            $table->integer('kategori')->default(0);
            $table->timestamps();
        });
        // Schema::table('outs', function (Blueprint $table) {
        //     $table->unsignedInteger('stoks_id');
        
        //     $table->foreign('stoks_id')->references('id')->on('stoks');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outs');
    }
}
