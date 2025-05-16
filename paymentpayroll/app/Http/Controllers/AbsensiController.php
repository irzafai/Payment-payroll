<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function presensiMasuk()
    {
        $karyawan = Karyawan::where('email', Auth::user()->email)->firstOrFail();

        $today = Carbon::today();
        $sudahAbsenMasuk = Absensi::where('karyawan_id', $karyawan->id)
            ->whereDate('waktu_masuk', $today)
            ->whereNotNull('waktu_masuk')
            ->whereNull('waktu_pulang')
            ->exists();

        if ($sudahAbsenMasuk) {
            return back()->with('error', 'Anda sudah melakukan presensi masuk hari ini.');
        }

        Absensi::create([
            'karyawan_id' => $karyawan->id,
            'waktu_masuk' => now(),
        ]);

        return back()->with('success', 'Presensi masuk berhasil!');
    }

    public function presensiPulang()
    {
        $karyawan = Karyawan::where('email', Auth::user()->email)->firstOrFail();

        $today = Carbon::today();
        $absensiHariIni = Absensi::where('karyawan_id', $karyawan->id)
            ->whereDate('waktu_masuk', $today)
            ->whereNotNull('waktu_masuk')
            ->whereNull('waktu_pulang')
            ->first();

        if (!$absensiHariIni) {
            return back()->with('error', 'Anda belum melakukan presensi masuk hari ini.');
        }

        $absensiHariIni->update([
            'waktu_pulang' => now(),
        ]);

        return back()->with('success', 'Presensi pulang berhasil!');
    }

    public function riwayatAbsensiKaryawan()
    {
        $karyawan = Karyawan::where('email', Auth::user()->email)->firstOrFail();
        $absensis = Absensi::where('karyawan_id', $karyawan->id)->latest()->paginate(10);
        return view('karyawan.absensi.riwayat', compact('absensis'));
    }

    public function rekapAbsensiAdmin()
    {
        $absensis = Absensi::with('karyawan')->latest()->paginate(10);
        return view('admin.absensi.rekap', compact('absensis'));
    }

    public function hitungGajiBulanan()
    {
        $karyawans = Karyawan::all();
        $bulanIni = Carbon::now()->startOfMonth();
        $akhirBulanIni = Carbon::now()->endOfMonth();
        $potonganPerHari = 50000; // Contoh potongan ketidakhadiran per hari

        foreach ($karyawans as $karyawan) {
            $jumlahAbsen = Absensi::where('karyawan_id', $karyawan->id)
                ->whereBetween('waktu_masuk', [$bulanIni, $akhirBulanIni])
                ->whereNull('waktu_masuk') // Hitung yang tidak masuk
                ->count();

            $potongan = $jumlahAbsen * $potonganPerHari;
            $gajiBersih[$karyawan->id] = $karyawan->gaji_pokok - $potongan;
        }

        return view('admin.gaji.rekap', compact('gajiBersih', 'karyawans'));
    }
};
