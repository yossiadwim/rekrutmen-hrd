<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeAnalisa extends Model
{
    use HasFactory;

    protected $table = 'tipe_analisa';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function jenisAnalisa(){
        return $this->hasMany(JenisAnalisa::class,'id_tipe_analisa','id_tipe_analisa');
    }
}
