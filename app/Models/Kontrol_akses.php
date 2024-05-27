<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrol_akses extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_lvl_manej', 'dshbrd_admin', 'verif_token',
        'anti_csrf', 'pnjelajah_dirt', 'cttan_user_lvl_manej',
        'cttan_dshbrd_admin', 'cttan_verif_token', 'cttan_anti_csrf',
        'cttan_pnjelajah_dirt', 'foto_data_validasi', 'foto_dashbrd_admin',
        'foto_anti_csrf', 'foto_penjelajahan_direktori', 'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function getFotoDataValidasiAttribute($value)
    {
        return asset('/storage/assessment/kontrol_akses/foto_data_validasi/' . $value);
    }

    public function getFotoDashbrdAdminAttribute($value)
    {
        return asset('/storage/assessment/kontrol_akses/foto_dashbrd_admin/' . $value);
    }

    public function getFotoAntiCsrfAttribute($value)
    {
        return asset('/storage/assessment/kontrol_akses/foto_anti_csrf/' . $value);
    }

    public function getFotoPenjelajahanDirektoriAttribute($value)
    {
        return asset('/storage/assessment/kontrol_akses/foto_penjelajahan_direktori/' . $value);
    }
}
