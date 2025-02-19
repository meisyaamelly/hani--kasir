<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function index()
{
    $penjualan = Penjualan::all(); // Ambil semua data penjualan
    return view('admin.penjualan.index', compact('penjualan'));
}

    public function getDetail($id)
{
    try {
        $details = DB::table('detailpenjualan')
        ->join('produk', 'detailpenjualan.ProdukID', '=', 'produk.ProdukID')
        ->select(
            'produk.NamaProduk as nama_produk',
            'detailpenjualan.JumlahProduk as jumlah',
            'produk.Harga as harga_satuan',
            DB::raw('detailpenjualan.JumlahProduk * produk.Harga as subtotal')
        )
        ->where('detailpenjualan.PenjualanID', $id)
        ->get();
    

        if ($details->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($details);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function destroy($id)
{
    \Log::info('Masuk ke metode destroy dengan ID: ' . $id);

    $penjualan = Penjualan::find($id);

    if (!$penjualan) {
        \Log::error('Data dengan ID ' . $id . ' tidak ditemukan.');
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    try {
        $penjualan->delete();
        \Log::info('Data berhasil dihapus.');
        return response()->json(['success' => 'Data berhasil dihapus']);
    } catch (\Exception $e) {
        \Log::error('Error saat menghapus: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }
}


}
