<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPelamar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'dokumen_pelamar';
    public $timestamps = false;
    
    public function dokumenPelamarLowongan(){
        return $this->hasMany(DokumenPelamarLowongan::class,'id_dokumen','id');
    }



}

