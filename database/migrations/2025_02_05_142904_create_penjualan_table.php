<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('PenjualanID');
            $table->date('TanggalPenjualan');
            $table->decimal('TotalHarga', 10, 2);
            $table->unsignedBigInteger('PelangganID');
            $table->timestamps();

            $table->foreign('PelangganID')->references('PelangganID')->on('pelanggan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
};
