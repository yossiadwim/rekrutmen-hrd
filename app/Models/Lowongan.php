<?php

namespace App\Models;

use App\Models\Departemen;
use App\Models\PelamarLowongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;

class Lowongan extends Model
{
    use HasFactory, Sluggable, Notifiable;

    protected $guarded = ['id'];
    public $table = 'lowongan';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen', 'id_departemen');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_lowongan'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function pelamarLowongan()
    {
        return $this->hasMany(PelamarLowongan::class, 'id_lowongan', 'id');
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search ?? false, function ($query, $keyword) {

            return $query->whereRaw('LOWER(nama_lowongan) like ?', ['%' . strtolower($keyword) . '%']);

        });
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['tanggal'] ?? false, function ($query, $search) {
            return $query->whereRaw('lowongan.created_at::date =?', $search);
        });

        $query->when($filters['tipe_lowongan'] ?? false, function ($query, $search) {
            return $query->where('lowongan.tipe_lowongan', $search);
        });

        $query->when($filters['kode_departemen'] ?? false, function ($query, $search) {
            return $query->where('departemen.kode_departemen', $search);
        });

        $query->when($filters['sort'] ?? false, function ($query, $search) {
            if($search == 'ASC'){
                return $query->orderBy('created_at','asc');
            }
            else if($search == 'DESC'){
                return $query->orderBy('created_at','desc');
            }
        });
    }
}
