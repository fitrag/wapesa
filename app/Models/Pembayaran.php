<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
    public function jenisbayar(){
        return $this->belongsTo(Jenisbayar::class);
    }
    public function riwayatbayars(){
        return $this->hasMany(Riwayatbayar::class);
    }
}
