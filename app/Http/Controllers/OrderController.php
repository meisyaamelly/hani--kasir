<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index($idPelanggan)
    {
        $produk = DB::table('produk')->get();
        return view('petugas.order', compact('produk', 'idPelanggan'));
    }

    public function store(Request $request)
{
    $penjualanID = DB::table('penjualan')->insertGetId([
        'TanggalPenjualan' => now(),
        'TotalHarga' => $request->input('TotalHarga'),
        'PelangganID' => $request->input('PelangganID'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $cart = json_decode($request->input('Cart'), true);

    foreach ($cart as $item) {
        DB::table('detailpenjualan')->insert([
            'PenjualanID' => $penjualanID,
            'ProdukID' => $item['ProdukID'],
            'JumlahProduk' => $item['JumlahProduk'],
            'Subtotal' => $item['JumlahProduk'] * $this->getProductPrice($item['ProdukID']),
            'NominalPembayaran' => $request->input('NominalPembayaran'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kurangi stok produk
        DB::table('produk')
            ->where('ProdukID', $item['ProdukID'])
            ->decrement('Stok', $item['JumlahProduk']);
    }

    return response()->json(['penjualanID' => $penjualanID]);
}

private function getProductPrice($produkID)
{
    $product = DB::table('produk')->where('ProdukID', $produkID)->first();
    return $product ? $product->Harga : 0;
}

}