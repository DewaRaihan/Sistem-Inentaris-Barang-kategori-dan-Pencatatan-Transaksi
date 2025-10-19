<?php

namespace App\Http\Controllers;

use App\Models\GudangBarang;
use App\Models\KategoriBarang;
use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TransaksiBarangController extends Controller
{
    /**
     * Tampilkan daftar transaksi.
     * menggunakan paginasi.
     */
    public function index()
    {
        $transaksi = Transaksi::with(['gudangBarang.kategori'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Form transaksi masuk barang baru.
     * method GET
     */
    public function create()
    {
        //mengambil data kategori barang untuk ditampilkan di form tambah barang baru
        $kategori = KategoriBarang::orderBy('name')->get();
        return view('transaksi.create', compact('kategori'));
    }

    /**
     * Generate kode barang otomatis (misal: BRG001, BRG002, dst).
     */
    private function generateKodeBarang()
    {
        //mengambil data barang terakhir untuk menentukan kode barang selanjutnya
        $last = GudangBarang::orderBy('id', 'desc')->first();
        $nextNumber = $last ? ((int) substr($last->kode_barang, 3)) + 1 : 1;
        return 'BRG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Transaksi masuk — barang baru.
     * method POST
     */
    public function IncomingTransaction(Request $request)
    {
        // validasi input
        $request->validate([
            'nama_barang' => 'required|string',
            'kategori_id' => 'required|exists:kategori_barangs,id',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);
        
        // menambahkan barang baru ke gudang
        $gudang = GudangBarang::create([
            'kode_barang' => $this->generateKodeBarang(),
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
        ]);

        // mencatat transaksi masuk kedalam tabel transaksi
        Transaksi::create([
            'barang_id' => $gudang->id,
            'jenis_transaksi' => 'masuk',
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan ?? "tidak ada keterangan",
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Barang baru berhasil ditambahkan.');
    }
    
    /**
     * Form update stok barang yang sudah ada.
     * method GET
     */
    public function update()
    {
        //mengambil data gudang barang untuk ditampilkan di form update stok saat mau input transaksi
        $gudang = GudangBarang::orderBy('nama_barang')->get();
        return view('transaksi.update', compact('gudang'));
    }
    /**
     * Transaksi masuk — update stok barang yang sudah ada.
     * method POST
     */
    public function updateTransaction(Request $request)
    {
        // validasi input
        $request->validate([
            'barang_id' => 'required|exists:gudang_barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // mencari barang di gudang, dan menambahkan jumlah stok
        $gudang = GudangBarang::findOrFail($request->barang_id);
        $gudang->increment('jumlah', $request->jumlah);

        // mencatat transaksi masuk kedalam tabel transaksi
        Transaksi::create([
            'barang_id' => $gudang->id,
            'jenis_transaksi' => 'masuk',
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan ?? "tidak ada keterangan",
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Stok barang berhasil diperbarui.');
    }

    /**
     * Form transaksi keluar barang.
     * method GET
     */
    public function destroy()
    {
        $gudang = GudangBarang::orderBy('nama_barang')->get();
        return view('transaksi.outbound', compact('gudang'));
    }
    /**
     * Transaksi keluar — pengurangan stok barang.
     * method POST
     */
    public function OutboundTransaction(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:gudang_barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // mencari barang di gudang, dan mengurangi jumlah stok
        $gudang = GudangBarang::findOrFail($request->barang_id);

        if ($gudang->jumlah < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok barang tidak mencukupi.']);
        }

        $gudang->decrement('jumlah', $request->jumlah);

        Transaksi::create([
            'barang_id' => $gudang->id,
            'jenis_transaksi' => 'keluar',
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan ?? "tidak ada keterangan",
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi keluar berhasil dicatat.');
    }
}
