<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';

    public function lowongan()
    {

        return $this->hasMany(Lowongan::class);
    }

    public function sluggable(): array
    {
        return [
            'kode_departemen' => [
                'source' => 'kode_departemen'
            ]
        ];
    }
}
