<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = ['PelangganID', 'NamaPelanggan', 'Alamat', 'NomorTelepon'];
}
