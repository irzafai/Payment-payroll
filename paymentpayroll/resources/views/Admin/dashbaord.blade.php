<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Dashboard Admin</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-semibold mb-2">Kelola Karyawan</h2>
                <p><a href="{{ route('admin.karyawan.index') }}" class="text-blue-500 hover:underline">Lihat Data Karyawan</a></p>
                <p><a href="{{ route('admin.karyawan.create') }}" class="text-green-500 hover:underline">Tambah Karyawan</a></p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-semibold mb-2">Absensi</h2>
                <p><a href="{{ route('admin.absensi.rekap') }}" class="text-blue-500 hover:underline">Lihat Rekap Absensi</a></p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-semibold mb-2">Gaji</h2>
                <p><a href="{{ route('admin.gaji.rekap') }}" class="text-blue-500 hover:underline">Hitung Gaji Bulanan</a></p>
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