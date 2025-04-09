<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataAbsensiController extends Controller
{
    public function index() {
        return view('admin-view.data-absensi');
    }
}
