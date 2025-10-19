<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gudang_barangs', function (Blueprint $table) {
            $table->id();
            $table->string("kode_barang")->unique();
            $table->string("nama_barang");
            $table->foreignId("kategori_id")->constrained("kategori_barangs")->onDelete('cascade');
            $table->string("jumlah");
            $table->string("kondisi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gudang_barangs');
    }
};
