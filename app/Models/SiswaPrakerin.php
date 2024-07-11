<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaPrakerin extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function prakerin(){
        return $this->belongsTo(Prakerin::class);
    }
    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
}
