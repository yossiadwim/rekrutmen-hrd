<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesTertulis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        "tanggal_tes",
        "waktu_mulai",
        "waktu_selesai",
        "nama_pelamar",
        "id_pelamar_lowongan"
    ];
    protected $table = 'tes_tertulis';
    public $timestamps = false;
    protected $primaryKey = 'id_tes_tertulis';

    public function pelamarLowongan(){
        return $this->hasMany(PelamarLowongan::class,'id_pelamar_lowongan','id_pelamar_lowongan');
    }



    public function getRouteKeyName(): string
    {
        return 'id_tes_tertulis';
    }
}
