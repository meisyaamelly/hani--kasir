<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('ProdukID');
            $table->string('NamaProduk', 255);
            $table->string('Kategori', 50)->default('Makanan'); // Kolom Kategori dengan default 'Makanan'
            $table->decimal('Harga', 10, 2);
            $table->integer('Stok');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
};
