<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStokTelur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('produksi', function (Blueprint $table) {
            $table->increments('id_produksi');
            $table->date('tgl_produksi');
            $table->integer('jml_produksi');
            $table->enum('konfirmasi_stok', ['n', 'y']);
            $table->timestamps();
        });

        Schema::create('penjualan_telur', function (Blueprint $table) {
            $table->increments('id_penjualan_telur');
            $table->date('tgl_penjualan_telur');
            $table->integer('jml_penjualan_telur');
            $table->integer('harga_per_peti');
            $table->integer('total');
            $table->string('alamat');            
            $table->string('no_hp');
            $table->timestamps();
        });


        Schema::create('stok_telur', function (Blueprint $table) {
            $table->increments('id_stok_telur');
            $table->integer('produksi_id')->nullable()->unsigned();
            $table->integer('penjualan_telur_id')->nullable()->unsigned();
            $table->date('tgl_stok_telur');
            $table->integer('telur_masuk');
            $table->integer('telur_keluar');
            $table->timestamps();

            $table->foreign('produksi_id')->references('id_produksi')->on('produksi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penjualan_telur_id')->references('id_penjualan_telur')->on('penjualan_telur')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::drop('produksi');
        Schema::drop('penjualan_telur');
        Schema::drop('stok_telur');
    }
}
