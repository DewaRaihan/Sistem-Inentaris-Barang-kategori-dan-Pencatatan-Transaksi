<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = "kategori_barangs";

    protected $fillable = [
        'name',
    ];

    public function gudangBarang(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GudangBarang::class, 'kategori_id');
    }
}
