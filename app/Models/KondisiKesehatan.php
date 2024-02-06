<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiKesehatan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];
    protected $table = 'riwayat_kesehatans';

    public function pelamar(){
        return $this->belongsTo(Pelamar::class,'id_pelamar','id');
    }
}
