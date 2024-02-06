<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemampuanKomputer extends Model
{
    use HasFactory;

    protected $table = 'kemampuan_komputers';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function pelamar(){
        return $this->belongsTo(Pelamar::class,'id_pelamar','id');
        
    }

}
