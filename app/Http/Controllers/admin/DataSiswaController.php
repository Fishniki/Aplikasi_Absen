<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        $kelas_jurusan = $request->kelas_jurusan;

        if ($kelas_jurusan == 'All') {
            $data_siswa = Siswa::all();
        } elseif ($kelas_jurusan) {
            $pisah = explode(' ', $kelas_jurusan);
            $kelas = $pisah[0];
            $jurusan = $pisah[1];

            $data_siswa = Siswa::where('kelas', $kelas)
                        ->where('jurusan', $jurusan)
                        ->get();
        } else {
            $data_siswa = collect();
        }

        return view('admin-view.data-siswa', compact('data_siswa'));
    }

    

}
