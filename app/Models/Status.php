<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'status';
    public $timestamps = false;
    protected $primaryKey = 'id_status';

    public function statusLamaran(){
        return $this->hasMany(StatusLamaran::class,'id_status','id');
    }

    public function activityLog(){
        return $this->belongsTo(ActivityLog::class,'id_status','id');
    }
}
