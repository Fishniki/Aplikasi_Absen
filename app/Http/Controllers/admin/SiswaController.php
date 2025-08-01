<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        return view('admin-view.form-siswa');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|numeric', // ini untuk Nis
            'nama' => 'required|string',
            'kelas' => 'required',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Siswa::create([
            'nis' => $request->nis,
            'name' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('admin.data-siswa', ['kelas' => 'All', 'jurusan' => 'All'])
        ->with('success', 'Data siswa berhasil di tambahkan.');
    }

    public function edit($id)
    {
        $siswa_byid = Siswa::findOrFail($id);
        return view('admin-view.edit-siswa', compact('siswa_byid'));
    }

    public function saveChanges(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|numeric', // ini untuk Nis
            'nama' => 'required|string',
            'kelas' => 'required',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Siswa::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('admin.data-siswa', ['kelas' => 'All', 'jurusan' => 'All'])
        ->with('success', 'Data Siswa Berhasil Diubah');
    }

    public function delete($id)
    {
        // Ambil data siswa dulu
        $siswa = Siswa::where('id', $id)->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Hapus user
        User::where('id', $siswa->user_id)->delete();

        // Hapus siswa
        Siswa::where('id', $id)->delete();

        // hapus foto profile
        if ($siswa->image && Storage::disk('public')->exists($siswa->image)) {
            Storage::disk('public')->delete($siswa->image);
        }

        return redirect()->route('admin.data-siswa', ['kelas_jurusan' => 'All'])
            ->with('success', 'Data siswa berhasil dihapus.');
    }


}
