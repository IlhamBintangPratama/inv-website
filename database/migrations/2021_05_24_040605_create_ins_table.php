<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ins', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('stoks_id');
            $table->integer('nm_brg1');
            $table->integer('jns_brg1');
            $table->float('jumlah');
            $table->string('tanggal');
            $table->string('hrg_item');
            $table->integer('awal');
            $table->integer('suplier_id');
            $table->integer('total');
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
        Schema::dropIfExists('ins');
    }
}
