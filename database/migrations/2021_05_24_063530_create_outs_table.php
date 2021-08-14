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
            $table->string('nm_brg');
            $table->string('jns_brg');
            $table->string('jumlah');
            $table->string('tanggal');
            $table->string('kategori');
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
