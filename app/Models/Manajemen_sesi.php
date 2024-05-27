<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemen_sesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_url', 'manej_sesi', 'set_sesi',
        'back_sesi_out', 'aunten_12_jam', 'satu_akun_satu_user',
        'satu_akun_berbagai_device', 'cttan_token_url', 'cttan_manej_sesi',
        'cttan_set_sesi', 'cttan_back_sesi_out', 'cttan_auten_12_jam',
        'cttan_satu_akun_satu_user', 'cttan_satu_akun_berbagai_device', 'foto_manej_sesi',
        'foto_set_sesi', 'foto_aunten', 'foto_satu_akun_berbagai_device',
        'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function getFotoManejSesiAttribute($value)
    {
        return asset('/storage/assessment/manajemen_sesi/foto_manej_sesi/' . $value);
    }

    public function getFotoSetSesiAttribute($value)
    {
        return asset('/storage/assessment/manajemen_sesi/foto_set_sesi/' . $value);
    }

    public function getFotoAuntenAttribute($value)
    {
        return asset('/storage/assessment/manajemen_sesi/foto_aunten/' . $value);
    }

    public function getFotoSatuAkunBerbagaiDeviceAttribute($value)
    {
        return asset('/storage/assessment/manajemen_sesi/foto_satu_akun_berbagai_device/' . $value);
    }
}
