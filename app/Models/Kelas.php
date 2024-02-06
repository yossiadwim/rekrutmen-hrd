<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'id_kelas';
    protected $table = 'kelas';

    public function komponenGaji(){
        return $this->hasMany(KomponenGaji::class,'id_kelas','id_kelas');
    }
}
