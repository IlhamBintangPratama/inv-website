<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEoqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoqs', function (Blueprint $table) {
            $table->increments('id', true);
            $table->date('tanggal');
            $table->integer('items_id')->unsigned();
            $table->integer('types_id')->unsigned();
            $table->string('hrg_item');
            $table->string('by_pesan');
            $table->string('by_simpan');
            $table->string('permintaan');
            $table->string('eoq');
            $table->timestamps();

            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eoqs');
    }
}
