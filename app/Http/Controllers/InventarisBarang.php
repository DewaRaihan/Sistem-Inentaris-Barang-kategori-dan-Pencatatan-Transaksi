<?php

namespace App\Http\Controllers;

use App\Models\GudangBarang;
use Illuminate\Http\Request;

class InventarisBarang extends Controller
{
    /**
     * Tampilkan semua data barang untuk halaman gudang.
     * menggunakan paginasi.
     */
    public function index()
    {
        $gudang = GudangBarang::orderBy('id', 'desc')->paginate(5);
        return view('inventaris.index', compact('gudang'));
    }   
}