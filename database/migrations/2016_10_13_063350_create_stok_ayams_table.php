<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokAyamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('penjualan_ayam', function (Blueprint $table) {
            $table->increments('id_penjualan_ayam');
            $table->date('tgl_penjualan_ayam');
            $table->integer('jml_penjualan_ayam');
            $table->integer('harga_per_ayam');
            $table->integer('total');
            $table->string('alamat');            
            $table->string('no_hp');
            $table->timestamps();
        });

        Schema::create('stok_ayam', function (Blueprint $table) {
            $table->increments('id_stok_ayam');
            $table->integer('pembelian_id')->nullable()->unsigned();
            $table->integer('penjualan_ayam_id')->nullable()->unsigned();
            $table->date('tgl_stok_ayam');
            $table->integer('ayam_masuk');
            $table->integer('ayam_keluar');
            $table->timestamps();

            $table->foreign('pembelian_id')->references('id_pembelian')->on('pembelian')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penjualan_ayam_id')->references('id_penjualan_ayam')->on('penjualan_ayam')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_ayams');
    }
}
