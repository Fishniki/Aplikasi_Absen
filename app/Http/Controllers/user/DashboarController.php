<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboarController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
    
        $absensi = Absensi::whereHas('siswa', function ($query) use ($siswa) {
            $query->where('kelas', $siswa->kelas)
                  ->where('jurusan', $siswa->jurusan);
        })->with('siswa')->latest()->get();
    
        return view('dashboard-user', compact('absensi', 'siswa'));
    }
}
