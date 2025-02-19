<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
{
    $totalEmployee = User::where('role', 'employee')->count();
    $totalAdmin = User::where('role', 'admin')->count();
    $totalTransaksi = Penjualan::count();
    $totalProduct = Produk::count();
    $sales = Penjualan::all();


    
    return view('admin.dashboard', compact('totalEmployee', 'totalAdmin', 'totalTransaksi', 'totalProduct', 'sales'));
}
}
