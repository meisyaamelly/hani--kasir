<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $fillable = ['PenjualanID', 'TanggalPenjualan', 'TotalHarga', 'PelangganID'];
    protected $primaryKey = 'PenjualanID';

}