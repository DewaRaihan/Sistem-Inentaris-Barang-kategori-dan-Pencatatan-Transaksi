<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GudangBarang extends Model
{
    protected $table = "gudang_barangs";
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'jumlah',
        'kondisi',
    ];

    public function kategori(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function transaksi(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaksi::class, 'barang_id');
    }
}
