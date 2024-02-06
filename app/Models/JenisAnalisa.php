<?php

namespace App\Models;

use App\Models\TipeAnalisa;
use App\Models\JenisAnalisaKriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAnalisa extends Model
{
    use HasFactory;

    protected $table = 'jenis_analisa';
    protected $guarded = ['id'];
    protected $primaryKey = 'id_jenis_analisa';
    public $timestamps = false;

    public function tipeAnalisa(){
        return $this->belongsTo(TipeAnalisa::class,'id_tipe_analisa','id_tipe_analisa');
    }

    public function jenisAnalisaKriteria(){
        return $this->hasMany(JenisAnalisaKriteria::class,'id_jenis_analisa','id_jenis_analisa');
    }

    public function hasilAnalisa(){
        return $this->hasMany(HasilAnalisa::class,'id_jenis_analisa','id_jenis_analisa');
    }

    public function scopeBebanIndeksPendidikan(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',1);
    }

    public function scopeBebanIndeksPengalaman(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',2);
    }

    public function scopeBebanIndeksKeterampilanHubungan(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',3);
    }

    public function scopeBebanIndeksManajemen(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',4);
    }

    public function scopeBebanIndeksTantanganBerpikir(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',5);
    }

    public function scopeBebanIndeksLingkunganBerpikir(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',6);
    }

    public function scopeBebanIndeksKebebasanBertindak(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',7);
    }

    public function scopeBebanIndeksSikapDanBesaranDampak(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',8);
    }
    
    public function scopeBebanIndeksSignifikansiAreaDampak(Builder $query){
        return $query->join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'jenis_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->select('*')
            ->where('tipe_analisa.id_tipe_analisa',9);
    }
}
