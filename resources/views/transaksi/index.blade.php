@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Daftar Transaksi Barang</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-5 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Kode Barang</th>
                    <th class="px-4 py-2 text-left">Jenis Transaksi</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($transaksi as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $item->gudangBarang->kode_barang ?? '-' }}</td>
                        <td class="px-4 py-2 capitalize">
                            <span class="px-2 py-1 rounded text-white {{ $item->jenis_transaksi == 'masuk' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $item->jenis_transaksi }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $item->jumlah }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $transaksi->links() }}
    </div>
</div>
@endsection
