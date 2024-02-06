<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'id_referensi';
    protected $table = 'referensi';
    public $timestamps = false;

    public function pelamar(){
        return $this->belongsTo(Pelamar::class,'id_pelamar','id');
    }
}
