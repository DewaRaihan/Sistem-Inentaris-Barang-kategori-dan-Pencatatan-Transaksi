<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventaris Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 font-sans text-gray-800 min-h-screen flex flex-col">

    {{-- Header --}}
    @include('layouts.header')

    {{-- Main content --}}
    <main class="flex-grow max-w-5xl w-full mx-auto mt-8 mb-8 p-6 bg-white rounded-lg shadow-md">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
