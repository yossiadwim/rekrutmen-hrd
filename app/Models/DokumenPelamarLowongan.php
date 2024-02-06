<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPelamarLowongan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'dokumen_pelamar_lowongan';
   

    public function dokumenPelamar(){
        return $this->belongsTo(DokumenPelamar::class,'id_dokumen','id');
    
    }

    public function pelamarLowongan(){
        return $this->belongsTo(PelamarLowongan::class);
    }
}
