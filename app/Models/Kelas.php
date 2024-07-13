<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [''];
   
    public function siswas(){
        return $this->hasMany(Siswa::class);
    }
    public function wali_kelass(){
        return $this->hasMany(WaliKelas::class);
    }
    public function jadwal_sekolahs(){
        return $this->hasMany(JadwalSekolah::class);
    }
}
