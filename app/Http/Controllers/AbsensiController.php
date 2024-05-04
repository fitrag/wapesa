<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function scan(){
        return view('admin.absensi.scan');
    }
}
