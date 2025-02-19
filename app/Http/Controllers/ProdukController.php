<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = DB::table('produk')->get();
        return view('admin.produk.produk', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaProduk' => 'required|max:255',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('asset/image'), $imageName);
            $imagePath = 'asset/image/' . $imageName;
        }

        DB::table('produk')->insert([
            'NamaProduk' => $request->input('NamaProduk'),
            'Kategori' => $request->input('Kategori'),
            'Harga' => $request->input('Harga'),
            'Stok' => $request->input('Stok'),
            'image' => $imagePath, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = DB::table('produk')->where('ProdukID', $id)->first();
        return view('admin.produk.edit', compact('produk'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaProduk' => 'required|max:255',
            'Kategori' => 'required',
            'Harga' => 'required|numeric',
            'Stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produk = DB::table('produk')->where('ProdukID', $id)->first();
        $imagePath = $produk->image;
    
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath) {
                \Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('produk_images', 'public');
        }
    
        DB::table('produk')->where('ProdukID', $id)->update([
            'NamaProduk' => $request->input('NamaProduk'),
            'Kategori' => $request->input('Kategori'),
            'Harga' => $request->input('Harga'),
            'Stok' => $request->input('Stok'),
            'image' => $imagePath,
            'updated_at' => now(),
        ]);
    
        return redirect('/admin/produk')->with('success', 'Produk berhasil diperbarui.');
    }
    

    public function delete($id)
    {
        DB::table('produk')->where('ProdukID', $id)->delete();
        return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus.');
    }
    
    public function search(Request $request)
{
    $search = $request->input('query');
    $produk = Produk::where('NamaProduk', 'LIKE', "%{$search}%")
                    ->orWhere('Kategori', 'LIKE', "%{$search}%")
                    ->get();

    return response()->json($produk);
}

}
