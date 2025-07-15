<?php

namespace App\Http\Controllers\user;

use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function index($id)
    {
        if(Auth::user()->id != $id){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat halaman tersebut.');
            // abort(403, 'Akses ditolak.');
        }
        $siswa_byuser_id = Siswa::where('user_id', $id)->first();
        return view('profile-user', compact('siswa_byuser_id'));
    }

    public function edit($id)
    {
        $profile = Siswa::where('user_id', $id)->first();
        if (Auth::id() != $id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat halaman tersebut.');
        }
        
        if($profile->lengkap === "sudah"){
            return redirect()->route('user.profile', $profile->user_id)->with('error', 'Profile anda suudah lengkap silahkan, hubungi guru jika ada kesalahan');
        }


        $siswa_byuser_id = Siswa::where('user_id', $id)->first();
        return view('profile-user-edit', compact('siswa_byuser_id'));
    }

    public function saveChanges(Request $request, $id)
    {

        $profil = Siswa::where('user_id', Auth::id())->first();
        // echo $profil->user_id;

        if ($profil->user_id != $id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat halaman tersebut.');
        }elseif($profil->lengkap === "sudah"){
            return redirect()->back()->with('error', 'Anda sudah melengkapi profil');
        }

        $validator = Validator::make($request->all(), [
            'nis' => 'required|numeric',
            'nama' => 'required|string',
            'kelas' => 'required',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $siswa = Siswa::where('user_id', $id)->firstOrFail();

        // Jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($siswa->image && Storage::disk('public')->exists($siswa->image)) {
                Storage::disk('public')->delete($siswa->image);
            }

            // Upload dan simpan gambar baru
            $profil_image = $request->file('image')->store('profil-user', 'public');
            $siswa->image = $profil_image;
        }

        // Update data lainnya
        $siswa->nis = $request->nis;
        $siswa->name = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->jurusan = $request->jurusan;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->lengkap = "sudah";
        $siswa->save();

        return redirect()->route('user.profile', Auth::user()->id)
            ->with('success', 'Data Siswa Berhasil Diubah');
    }

}
