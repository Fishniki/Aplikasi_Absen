<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $today = Carbon::today();

    // Filter berdasarkan kelas & jurusan jika tersedia
    $kelasFilter = $request->kelas_jurusan;
    $kelas = preg_replace('/\D/', '', $kelasFilter);
    $jurusan = preg_replace('/\d/', '', $kelasFilter);

    $absensiQuery = Absensi::with('siswa')->whereDate('created_at', $today);

    if ($kelasFilter) {
        $absensiQuery->whereHas('siswa', function ($q) use ($kelas, $jurusan) {
            $q->where('kelas', $kelas)->where('jurusan', $jurusan);
        });
    }

    $absensis = $absensiQuery->get();
    $totalSiswa = Siswa::when($kelasFilter, function ($query) use ($kelas, $jurusan) {
        return $query->where('kelas', $kelas)->where('jurusan', $jurusan);
    })->count();

    $jumlahAbsen = $absensis->count();
    $jumlahTerlambat = $absensis->where('kehadiran', 'Terlambat')->count();
    $jumlahSakit = $absensis->where('kehadiran', 'Sakit')->count();

    return view('admin-view.admin-dashboard', compact(
        'absensis', 'jumlahAbsen', 'totalSiswa', 'jumlahTerlambat', 'jumlahSakit'
    ));
}
}
