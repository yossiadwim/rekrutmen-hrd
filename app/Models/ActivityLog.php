<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'activity_log';
    protected $primaryKey = 'id_activity_log';

    public function statusLamaran(){
        return $this->belongsTo(StatusLamaran::class,'id_status_lamaran','id_status_lamaran');
    }

    public function pelamarLowongan(){
        return $this->belongsTo(PelamarLowongan::class,'id_pelamar_lowongan','id_pelamar_lowongan');
    }
    
    public function status(){
        return $this->hasMany(Status::class,'id','id_status');
    }
}
