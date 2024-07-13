<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function kelas()
    {
    	return $this->belongsTo(Kelas::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function absensis()
    {
    	return $this->hasMany(Absensi::class);
    }
    public function pembayarans()
    {
    	return $this->hasMany(Pembayaran::class);
    }
    public function siswaprakerin(){
        return $this->hasOne(SiswaPrakerin::class);
    }
}
