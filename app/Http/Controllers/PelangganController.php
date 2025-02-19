<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function index()
    {
        // Ambil semua data pelanggan dari database
        $pelanggan = DB::table('pelanggan')->get();

        // Tampilkan halaman pelanggan dengan data
        return view('petugas.pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'NamaPelanggan' => 'required|max:255',
        'Alamat' => 'required',
        'NomorTelepon' => 'required|max:15',
    ]);

    // Simpan data pelanggan dan dapatkan ID yang baru saja dibuat
    $idPelanggan = DB::table('pelanggan')->insertGetId([
        'NamaPelanggan' => $request->input('NamaPelanggan'),
        'Alamat' => $request->input('Alamat'),
        'NomorTelepon' => $request->input('NomorTelepon'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Redirect ke halaman order dengan membawa ID pelanggan
    return redirect('/petugas/order/' . $idPelanggan)->with('success', 'Pelanggan berhasil ditambahkan.');
}


    public function edit($id)
{
    $pelanggan = DB::table('pelanggan')->where('PelangganID', $id)->first();
    return view('petugas.pelanggan.edit', compact('pelanggan'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'NamaPelanggan' => 'required|max:255',
        'Alamat' => 'required',
        'NomorTelepon' => 'required|max:15',
    ]);

    DB::table('pelanggan')->where('PelangganID', $id)->update([
        'NamaPelanggan' => $request->input('NamaPelanggan'),
        'Alamat' => $request->input('Alamat'),
        'NomorTelepon' => $request->input('NomorTelepon'),
        'updated_at' => now(),
    ]);

    return redirect('/petugas/pelanggan')->with('success', 'Pelanggan berhasil diperbarui.');
}

public function delete($id)
{
    DB::table('pelanggan')->where('PelangganID', $id)->delete();
    return redirect('/petugas/pelanggan')->with('success', 'Pelanggan berhasil dihapus.');
}

}
