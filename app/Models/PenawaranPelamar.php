<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranPelamar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $table = 'penawaran_pelamar';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pelamarLowongan(){
        return $this->hasOne(PelamarLowongan::class,'id_pelamar_lowongan','id_pelamar_lowongan');
    }


}
