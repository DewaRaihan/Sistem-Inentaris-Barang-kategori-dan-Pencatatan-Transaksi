<header class="bg-gray-100 text-gray-800 py-4 border-b border-gray-300">
    <div class="max-w-5xl mx-auto text-center">
        <h1 class="text-2xl font-semibold mb-3">Inventaris Barang Kantor</h1>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('inventaris.index') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
               Barang
            </a>
            <a href="{{ route('transaksi.index') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
               Transaksi
            </a>
        </div>
    </div>
</header>
