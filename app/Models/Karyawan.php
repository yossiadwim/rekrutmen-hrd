<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_karyawan';
    protected $keyType = 'string';
    protected $table = 'karyawan';

    public function user(){
        return $this->hasOne(User::class,'id_karyawan','id_karyawan');
    }

    public function timSeleksi(){
        return $this->hasMany(TimSeleksi::class,'id_karyawan','id_karyawan');
    }

    public function jabatanKaryawan(){
        return $this->hasMany(JabatanKaryawan::class,'id_karyawan','id_karyawan');
    }

    public function statusLamaran(){
        return $this->hasMany(StatusLamaran::class,'approved_by','id_karyawan');
    }

    public function hasilAnalisa(){
        return $this->hasMany(HasilAnalisa::class,'id_karyawan','id_karyawan');
    }
}
