<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    use HasFactory;


    protected $table = 'application_form';
    protected $primaryKey = 'id_application_form';
    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pelamarLowongan()
    {
        return $this->belongsTo(PelamarLowongan::class, 'id_pelamar_lowongan', 'id_pelamar_lowongan');
    }
}
