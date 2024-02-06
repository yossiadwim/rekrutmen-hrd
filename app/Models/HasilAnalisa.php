<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAnalisa extends Model
{
    use HasFactory;
    protected $table = 'hasil_analisa';
    protected $guarded = ['id'];
    protected $primaryKey = 'id_hasil_analisa';
    public $timestamps = false;

    public function pelamarLowongan(){
        return $this->belongsTo(PelamarLowongan::class,'id_pelamar_lowongan','id_pelamar_lowongan');
    }

    public function karyawan(){
        return $this->belongsTo(Karyawan::class,'id_karyawan','id_karyawan');
    }

    public function jenisAnalisa(){
        return $this->belongsTo(JenisAnalisa::class,'id_jenis_analisa','id_jenis_analisa');
    }


}
