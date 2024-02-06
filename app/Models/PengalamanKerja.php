<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pengalaman_kerja';
    public $timestamps = false;


    public function pelamar(){
        return $this->belongsTo(Pelamar::class,'id_pelamar','id');
    }
}
