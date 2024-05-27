<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian_ui_ux extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_warna', 'penilaian_logo_kotabgr', 'penilaian_logo_apk',
        'penilaian_copyright_pemkot', 'penilaian_info_identitasopd', 'penilaian_info_apk',
        'penilaian_faq', 'penilaian_user_friendly', 'penilaian_fungsionalitas',
        'penilaian_dashboard', 'penilaian_log_user', 'cttan_penilaian_warna',
        'cttan_penilaian_logo_kota', 'cttan_penilaian_logo_apk', 'cttan_penilaian_cr_pemkot',
        'cttan_penilaian_identitas_odp', 'cttan_penilaian_info_apk', 'cttan_penilaian_faq',
        'cttan_penilaian_uiux_frendly', 'cttan_penilaian_fungsionalitas', 'cttan_penilaian_dashboard',
        'cttan_penilaian_log_usr', 'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
