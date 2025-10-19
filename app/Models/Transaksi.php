<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = "transaksis";
    protected $fillable = [
        'barang_id',
        'jenis_transaksi',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    public function gudangBarang(): BelongsTo
    {
        return $this->belongsTo(GudangBarang::class, 'barang_id');
    }
}
