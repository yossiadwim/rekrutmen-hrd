<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    protected $table = 'golongan';
    protected $primaryKey = 'id_golongan';
    protected $guarded = ['id'];
    

    public function komponenGaji(){
        return $this->hasMany(KomponenGaji::class,'id_golongan','id_golongan');
    }
}
