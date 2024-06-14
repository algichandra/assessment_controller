<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_apk', 'nama_kegiatan',
        'thn_anggaran', 'kegiatan_dpa',
        'cttan_dpa', 'pj', 'opd_id',
        'user_apk_id', 'jenis_kegiatan_id',
        'developer_id', 'programer_id'
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function user_apk()
    {
        return $this->belongsTo(User_apk::class);
    }

    public function jenis_kegiatan()
    {
        return $this->belongsTo(Jenis_kegiatan::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function programer()
    {
        return $this->belongsTo(Programer::class);
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
