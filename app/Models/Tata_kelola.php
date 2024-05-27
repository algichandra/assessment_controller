<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tata_kelola extends Model
{
    use HasFactory;

    protected $fillable = [
        'dok_kak_tor', 'laporan_dpa', 'sk_pengelola_apk',
        'sk_helpdesk_apk', 'laporan_akhir', 'sop',
        'panduan_apk', 'link_video_apk', 'panduan_apkserver',
        'dok_mnjresiko', 'dok_api', 'file_scapk', 'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function penilaian_tata_kelola()
    {
        return $this->hasOne(Penilaian_tata_kelola::class);
    }

    public function getDokKakTorAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/dok_kak_tor/' . $value);
    }

    public function getLaporanDpaAttribute($value)
    {
        return $value ? asset('/storage/assessment/tata_kelola/laporan_dpa/' . $value) : null;
    }

    public function getSkPengelolaApkAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/sk_pengelola_apk/' . $value);
    }

    public function getSkHelpdeskApkAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/sk_helpdesk_apk/' . $value);
    }

    public function getLaporanAkhirAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/laporan_akhir/' . $value);
    }

    public function getSopAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/sop/' . $value);
    }

    public function getPanduanApkAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/panduan_apk/' . $value);
    }

    public function getPanduanApkserverAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/panduan_apkserver/' . $value);
    }

    public function getDokMnjresikoAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/dok_mnjresiko/' . $value);
    }

    public function getDokApiAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/dok_api/' . $value);
    }

    public function getFileScapkAttribute($value)
    {
        return asset('/storage/assessment/tata_kelola/file_scapk/' . $value);
    }

    // protected function dok_kak_tor(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/dok_kak_tor/' . $value),
    //     );
    // }

    // protected function laporan_dpa(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/laporan_dpa/' . $value),
    //     );
    // }

    // protected function sk_pengelola_apk(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/sk_pengelola_apk/' . $value),
    //     );
    // }

    // protected function sk_helpdesk_apk(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/sk_helpdesk_apk/' . $value),
    //     );
    // }

    // protected function laporan_akhir(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/laporan_akhir/' . $value),
    //     );
    // }

    // protected function sop(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/sop' . $value),
    //     );
    // }

    // protected function panduan_apk(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/panduan_apk/' . $value),
    //     );
    // }

    // protected function panduan_apkserver(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/panduan_apkserver/' . $value),
    //     );
    // }

    // protected function dok_mnjresiko(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/dok_mnjresiko/' . $value),
    //     );
    // }

    // protected function dok_api(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/dok_api/' . $value),
    //     );
    // }

    // protected function file_scapk(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => asset('/storage/assessment/tata_kelola/file_scapk/' . $value),
    //     );
    // }
}
