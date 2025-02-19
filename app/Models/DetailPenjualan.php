<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = ['PenjualanID', 'ProdukID', 'JumlahProduk', 'Subtotal'];
}
