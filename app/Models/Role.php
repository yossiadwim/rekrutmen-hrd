<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'role';
    protected $primaryKey = 'id_role';

    public function userRole(){
        return $this->hasMany(UserRole::class);
    }
}
