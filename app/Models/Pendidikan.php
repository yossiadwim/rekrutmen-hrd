<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pendidikan_karyawan';
    public $timestamps = false;
    protected $primaryKey = 'id_pendidikan';

    public function pelamar(){
        return $this->belongsTo(Pelamar::class,'id_pelamar','id');
    }
}
