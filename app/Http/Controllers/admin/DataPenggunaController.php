<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class DataPenggunaController extends Controller
{
    public function index()
    {
        $penggunas = User::where('role', 'admin')->get();
        return view('admin-view.pengguna', compact('penggunas'));
    }
}
