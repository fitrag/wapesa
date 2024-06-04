<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function tambah(){
        return view('admin.pembayaran.add');
    }
}
