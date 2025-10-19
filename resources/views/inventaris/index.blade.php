@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-8 bg-white p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Daftar Inventaris Barang</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-5 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('transaksi.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambah Barang</a>
        <a href="{{ route('transaksi.update') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Update Barang</a>
        <a href="{{ route('transaksi.destroy') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Barang Keluar</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Kode Barang</th>
                    <th class="px-4 py-2 text-left">Nama Barang</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Kondisi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($gudang as $barang)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $barang->kode_barang }}</td>
                        <td class="px-4 py-2">{{ $barang->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $barang->kategori->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $barang->jumlah }}</td>
                        <td class="px-4 py-2 capitalize">{{ $barang->kondisi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">Belum ada data barang</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
