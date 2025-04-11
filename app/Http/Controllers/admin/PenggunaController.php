<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('admin-view.form-pengguna');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|digits:18',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan ke database
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'role' => 'admin',
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.data-pengguna')->with('success', 'Data pengguna berhasil ditambahkan!');
    }

    public function edit($id) 
    {
        $user = User::where('id', $id)->where('role', 'admin')->firstOrFail();
        return view('admin-view.edit-pengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email',
            'nip' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $id)->where('role', 'admin')->firstOrFail();

        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
        ]);

        return redirect()->route('admin.data-pengguna', 'Data pengguna berhasil diperbarui!');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('sucsess', 'Data berhasil di hapus');
    }

}
