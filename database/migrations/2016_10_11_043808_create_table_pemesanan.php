<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->increments('id_pemesanan');
            $table->integer('user_id')->unsigned();
            $table->date('tgl_pemesanan');
            $table->integer('jml_pemesanan');
            $table->integer('harga_per_peti');
            $table->integer('total');
            $table->string('alamat');
            $table->enum('konfirmasi_pemesanan', ['n', 'y']);
            $table->string('no_hp');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('pemesanan');
    }
}
