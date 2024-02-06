<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanKaryawan extends Model
{
    use HasFactory;
    
    protected $table = 'jabatan_karyawan';
    protected $primaryKey = 'id_jabatan_karyawan';

    public function jabatan(){
        return $this->belongsTo(Jabatan::class,'id_jabatan','id_jabatan');
    }

    public function karyawan(){
        return $this->belongsTo(Karyawan::class,'id_karyawan','id_karyawan');
    }
}
