<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $kelas = $request->kelas_jurusan;
        $nis = $request->nis;
        $limit = $request->limit ?? 10;

        $absensiQuery = Absensi::with('siswa')
            ->whereDate('created_at', $today);

        if ($kelas) {
            $absensiQuery->whereHas('siswa', function ($q) use ($kelas) {
                $q->whereRaw("CONCAT(kelas, jurusan) = ?", [$kelas]);
            });
        }

        if ($nis) {
            $absensiQuery->whereHas('siswa', function ($q) use ($nis) {
                $q->where('nis', 'like', "%$nis%");
            });
        }

        $absensis = $absensiQuery->paginate($limit);

        return view('home-user', compact('absensis', 'limit', 'kelas', 'nis'));
    }
}
