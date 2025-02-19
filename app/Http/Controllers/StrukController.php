<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StrukController extends Controller
{
    public function show($penjualanID)
    {
        $penjualan = DB::table('penjualan')
            ->join('pelanggan', 'penjualan.PelangganID', '=', 'pelanggan.PelangganID')
            ->where('penjualan.PenjualanID', $penjualanID)
            ->select('penjualan.*', 'pelanggan.NamaPelanggan', 'pelanggan.Alamat', 'pelanggan.NomorTelepon')
            ->first();

        $detailPenjualan = DB::table('detailpenjualan')
            ->join('produk', 'detailpenjualan.ProdukID', '=', 'produk.ProdukID')
            ->where('detailpenjualan.PenjualanID', $penjualanID)
            ->select('detailpenjualan.*', 'produk.NamaProduk', 'produk.Harga')
            ->get();

        return view('petugas.struk', compact('penjualan', 'detailPenjualan'));
    }
}
