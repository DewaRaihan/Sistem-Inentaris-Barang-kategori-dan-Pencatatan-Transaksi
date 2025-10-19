@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 border-b pb-2">
        Tambah Barang Baru (Transaksi Masuk)
    </h2>

    @if ($errors->any())
        <div class="bg-red-50 text-red-800 p-4 rounded-lg mb-6 border border-red-200">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi.incoming') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama Barang</label>
            <input type="text" name="nama_barang" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Kategori</label>
            <select name="kategori_id" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Jumlah</label>
            <input type="number" name="jumlah" min="1" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Kondisi</label>
            <input type="text" name="kondisi" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
            <input type="date" name="tanggal" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Keterangan (Opsional)</label>
            <textarea name="keterangan"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition"></textarea>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('transaksi.index') }}"
                class="bg-gray-200 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit"
                class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
