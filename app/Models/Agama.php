<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'agama';
    protected $primaryKey = 'id_agama';

    public function pelamar(){
        return $this->hasMany(Pelamar::class, 'id_agama','id_agama');
    }
}
