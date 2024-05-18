<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LihatAbsensiController extends Controller
{
    public function absensitgl()
    {
        return view('admin.lihat-absensi.absensi-tgl');
    }
}
