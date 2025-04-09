<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index()
    {
        $siswa_byuser_id = Siswa::where('user_id', Auth::id())->first();

        $absen_bysiswa_id = Absensi::where('siswa_id', $siswa_byuser_id->id)->get();

        // Cek apakah sudah absen hari ini
        $absen_hari_ini = Absensi::where('siswa_id', $siswa_byuser_id->id)
            ->whereDate('created_at', now())
            ->first(); // ambil data absensi hari ini (kalau ada)

        return view('absen-user', compact('siswa_byuser_id', 'absen_bysiswa_id', 'absen_hari_ini'));
    }

    public function createAbsen(Request $request)
    {
        $now = Carbon::now()->setTimezone('Asia/Jakarta');
    
        // Hanya Senin - Jumat
        if ($now->isWeekend()) {
            return back()->with('error', 'Absensi hanya dibuka Senin sampai Jumat.');
        }
    
        // Waktu absensi
        $start = Carbon::createFromTime(6, 30, 0, 'Asia/Jakarta');
        $end = Carbon::createFromTime(8, 0, 0, 'Asia/Jakarta');
        $jam_terlambat = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta');
        $jam_alpha = Carbon::createFromTime(7, 30, 0, 'Asia/Jakarta');
    
        // Cek apakah sudah absen
        $sudah_absen = Absensi::where('siswa_id', $request->siswa_id)
            ->whereDate('created_at', $now->toDateString())
            ->exists();
    
        if ($sudah_absen) {
            return back()->with('error', 'Anda sudah melakukan absensi hari ini.');
        }
    
        if ($now->between($start, $end)) {
    
            // Validasi input
            $request->validate([
                'status' => 'required|in:Hadir,Izin,Sakit,Terlambat',
                'lokasi' => 'required|string',
                'alasan' => 'nullable|string|max:255',
                'bukti_sakit' => 'nullable|image|max:2048'
            ]);
    
            $kehadiran = $request->status;
            $keterangan = null;
            $bukti = null;
    
            if (in_array($kehadiran, ['Izin', 'Terlambat'])) {
                if (!$request->alasan) {
                    return back()->with('error', 'Alasan wajib diisi untuk Izin atau Terlambat.');
                }
                $keterangan = $request->alasan;
            }
    
            if ($kehadiran === 'Sakit') {
                if (!$request->hasFile('bukti_sakit')) {
                    return back()->with('error', 'Bukti sakit harus diunggah.');
                }
                $bukti = $request->file('bukti_sakit')->store('bukti_sakit', 'public');
            }
    
            Absensi::create([
                'siswa_id' => $request->siswa_id,
                'kehadiran' => $kehadiran,
                'lokasi' => $request->lokasi,
                'keterangan' => $keterangan,
                'bukti' => $bukti,
            ]);
    
            return back()->with('success', 'Absensi berhasil dicatat.');
        }
    
        // Absensi otomatis
        $status_otomatis = $now->between($jam_terlambat, $jam_alpha) ? 'Terlambat' : 'Alfa';
    
        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'kehadiran' => $status_otomatis,
            'lokasi' => $request->lokasi ?? 'Otomatis oleh sistem',
            'keterangan' => 'Absen otomatis oleh sistem',
            'bukti' => null,
        ]);
    
        return back()->with('info', "Absensi otomatis tercatat sebagai $status_otomatis.");
    }
}
