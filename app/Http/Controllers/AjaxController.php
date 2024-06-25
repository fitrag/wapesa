<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class AjaxController extends Controller
{
    public function siswaAll(Request $req){
        $siswas = Siswa::where('nis','like', '%'.$req->keyword.'%')->orWhere('nm_siswa','like', '%'.$req->keyword.'%')->get();
        return json_encode($siswas);
    }

    public function total(Request $req){
        return $req->all();
    }
}
