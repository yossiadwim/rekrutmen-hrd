<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimSeleksi extends Model
{
    use HasFactory;
    protected $table = 'tim_seleksi';
    protected $primaryKey = 'id_tim_seleksi';
    protected $guarded = ['id'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'id_karyawan','id_karyawan');
    }

    public function pelamarLowongan(){
        return $this->belongsTo(PelamarLowongan::class,'id_karyawan','id_karyawan');
    }
}
