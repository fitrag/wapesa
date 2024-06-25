<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru_ajar extends Model
{
    use HasFactory;
    protected $guarded = [''];
    
    public function guru(){
        return $this->belongsTo(Guru::class);
    }
    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }

}
