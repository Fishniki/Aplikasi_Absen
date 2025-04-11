<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class DataAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with('siswa');

        if ($request->kelas_jurusan) {
            $kelas = preg_replace('/\D/', '', $request->kelas_jurusan);
            $jurusan = preg_replace('/\d/', '', $request->kelas_jurusan);

            $query->whereHas('siswa', function ($q) use ($kelas, $jurusan) {
                $q->where('kelas', $kelas)->where('jurusan', $jurusan);
            });
        }

        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $absensis = $query->latest()->get();

        return view('admin-view.data-absensi', compact('absensis'));
    }

    public function edit(Request $request)
    {
        $kelas = preg_replace('/\D/', '', $request->kelas_jurusan);
        $jurusan = preg_replace('/\d/', '', $request->kelas_jurusan);

        $absensis = Absensi::with('siswa')
            ->whereDate('created_at', $request->tanggal)
            ->whereHas('siswa', function ($q) use ($kelas, $jurusan) {
                $q->where('kelas', $kelas)->where('jurusan', $jurusan);
            })
            ->get();

        return view('admin-view.edit-absensi', [
            'absensis' => $absensis,
            'tanggal' => $request->tanggal,
            'kelas_jurusan' => $request->kelas_jurusan
        ]);
    }

    public function update(Request $request)
    {
        foreach ($request->kehadiran as $id => $status) {
            Absensi::where('id', $id)->update([
                'kehadiran' => $status
            ]);
        }

        return redirect()->route('admin.absen-siswa', [
            'kelas_jurusan' => $request->kelas_jurusan,
            'tanggal' => $request->tanggal
        ])->with('success', 'Absensi berhasil diperbarui.');
    }

}
