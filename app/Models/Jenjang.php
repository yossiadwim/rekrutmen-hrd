<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'id_jenjang';
    protected $table = 'jenjang';

    public function komponenGaji(){
        return $this->hasMany(komponenGaji::class,'id_jenjang','id_jenjang');
    }
}
