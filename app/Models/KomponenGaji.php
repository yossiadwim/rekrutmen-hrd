<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Jenjang;
use App\Models\Golongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KomponenGaji extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'id_komponen_gaji';
    protected $table = 'komponen_gaji';

    public function golongan(){
        return $this->belongsTo(Golongan::class,'id_golongan','id_golongan');

    }

    public function kelas(){
        return $this->belongsTo(Kelas::class,'id_kelas','id_kelas');

    }

    public function jenjang(){
        return $this->belongsTo(Jenjang::class,'id_jenjang','jenjang');
    }

    
}
