<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Absensi</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Riwayat Absensi Anda</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Masuk</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pulang</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($absensis as $absensi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->waktu_masuk ? $absensi->waktu_masuk->format('Y-m-d') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->waktu_masuk ? $absensi->waktu_masuk->format('H:i:s') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->waktu_pulang ? $absensi->waktu_pulang->format('H:i:s') : '-' }}</td>
                        </tr>
                    @empty
                        <tr><td class="px-6 py-4 whitespace-nowrap text-center" colspan="3">Tidak ada data absensi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $absensis->links() }}
        </div>

        <a href="{{ route('karyawan.dashboard') }}" class="inline-block mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Kembali ke Dashboard</a>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>