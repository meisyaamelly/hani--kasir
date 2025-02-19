<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('detailpenjualan', function (Blueprint $table) {
            $table->integer('NominalPembayaran')->nullable()->after('Subtotal');
        });
    }
    
    public function down()
    {
        Schema::table('detailpenjualan', function (Blueprint $table) {
            $table->dropColumn('NominalPembayaran');
        });
    }
    
};
