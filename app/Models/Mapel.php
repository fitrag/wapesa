<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function guru(){
        return $this->belongsTo(Guru::class);
    }
    public function jadwal_sekolahs(){
        return $this->hasMany(JadwalSekolah::class);
    }
}
