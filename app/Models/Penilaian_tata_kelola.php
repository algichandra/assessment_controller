<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian_tata_kelola extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_dok_kak_tor', 'penilaian_laporan_dpa', 'penilaian_sk_pengelola_apk',
        'penilaian_sk_helpdesk_apk', 'penilaian_laporan_akhir', 'penilaian_sop', 'penilaian_panduan_apk',
        'penilaian_link_video_apk', 'penilaian_panduan_apkserver', 'penilaian_dok_mnjresiko',
        'penilaian_dok_api', 'penilaian_file_scapk', 'cttan_penilaian_kak_tor',
        'cttan_penilaian_lap_awal', 'cttan_penilaian_sk_pengelola_apk', 'cttan_penilaian_sk_helpdesk_apk',
        'cttan_penilaian_lap_akhir', 'cttan_penilaian_sop', 'cttan_penilaian_pduan_pnglola',
        'cttan_penilaian_vid_tutor_apk', 'cttan_penilaian_pand_apkserver', 'cttan_penilaian_manej_resiko',
        'cttan_penilaian_dok_api', 'cttan_penilaian_source_code', 'tata_kelola_id'
    ];

    public function tata_kelola()
    {
        return $this->belongsTo(Tata_kelola::class);
    }
}
