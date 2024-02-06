<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PelamarLowongan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pelamar_lowongan';
    public $timestamps = false;
    protected $primaryKey = 'id_pelamar_lowongan';
    protected $casts = [
        'tanggal_melamar' => 'datetime',
    ];

    // public function scopeDetailUser($query){

    // }

    public function dokumenPelamarLowongan()
    {
        return $this->hasMany(DokumenPelamarLowongan::class, 'id_pelamar_lowongan', 'id_pelamar_lowongan');
    }


    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id');
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan', 'id');
    }

    public function statusLamaran()
    {
        return $this->hasMany(StatusLamaran::class, 'id_pelamar_lowongan', 'id_pelamar_lowongan');
    }

    public function tesTertulis()
    {
        return $this->belongsTo(TesTertulis::class, 'id_pelamar_lowongan', 'id_pelamar_lowongan');
    }

    public function timSeleksi()
    {
        return $this->hasMany(TimSeleksi::class, 'id_karyawan', 'id_karyawan');
    }

    public function activityLog(){
        return $this->hasMany(ActivityLog::class, 'id_pelamar_lowongan','id_pelamar_lowongan');
    }

    public function hasilAnalisa(){
        return $this->hasMany(HasilAnalisa::class,'id_pelamar_lowongan','id_pelamar_lowongan');
    }

    public function applicationForm(){
        return $this->hasMany(ApplicationForm::class,'id_pelamar_lowongan','id_pelamar_lowongan');
    }

    public function penawaranPelamar(){
        return $this->hasOne(PenawaranPelamar::class,'id_pelamar_lowongan','id_pelamar_lowongan');
    }
}
