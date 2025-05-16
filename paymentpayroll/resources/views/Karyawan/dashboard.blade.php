<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Selamat datang, {{ Auth::user()->name }}!</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="bg-red-200 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h2 class="text-lg font-semibold mb-2">Presensi</h2>
                <form action="{{ route('karyawan.presensi.masuk') }}" method="POST" class="mb-2">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Presensi Masuk</button>
                </form>
                <form action="{{ route('karyawan.presensi.pulang') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Presensi Pulang</button>
                </form>
            </div>
            <div>
                <h2 class="text-lg font-semibold mb-2">Lainnya</h2>
                <p><a href="{{ route('karyawan.absensi.riwayat') }}" class="text-blue-500 hover:underline">Lihat Riwayat Absensi</a></p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="mt-8">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>