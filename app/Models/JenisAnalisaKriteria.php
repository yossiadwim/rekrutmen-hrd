<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAnalisaKriteria extends Model
{
    use HasFactory;

    protected $table = 'jenis_analisa_kriteria';
    // protected $casts = ['kriteria' => 'array'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function jenisAnalisa(){
        return $this->belongsTo(jenisAnalisa::class,'id_jenis_analisa','id_jenis_analisa');
    }
}
