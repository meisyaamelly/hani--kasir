<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id('DetailPenjualanID');
            $table->unsignedBigInteger('PenjualanID');
            $table->unsignedBigInteger('ProdukID');
            $table->integer('JumlahProduk');
            $table->decimal('Subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('PenjualanID')->references('PenjualanID')->on('penjualan')->onDelete('cascade');
            $table->foreign('ProdukID')->references('ProdukID')->on('produk')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detailpenjualan');
    }
};
