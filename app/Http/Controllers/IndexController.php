<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends Controller
{
    public function index(){
        $qrCode = QrCode::size(250)->generate('0011306181');
        return view('welcome', compact('qrCode'));
    }
    public function qrcode(){
        $qrCode = QrCode::size(80)->generate('0011306181');
        return view('qrcode', compact('qrCode'));
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
}
