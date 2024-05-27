<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian_otentifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_login', 'penilaian_captcha_login', 'penilaian_cpatcha_lain',
        'penilaian_daftar', 'penilaian_reset_password', 'penilaian_password_8_krtr',
        'penilaian_password_besar_kecil_khusus', 'penilaian_ukur_sandi', 'penilaian_tampil_sembunyi_sandi',
        'penilaian_valid_email_new_user', 'penilaian_verif_admin_new_user', 'penilaian_exp_password_1_thn',
        'penilaian_user_dibuat_admin', 'penilaian_reset_password_user_dibuat_admin', 'cttan_penilaian_login',
        'cttan_penilaian_captcha_login', 'cttan_penilaian_daftar', 'cttan_penilaian_reset_password',
        'cttan_penilaian_valid_pw_8_karakter', 'cttan_penilaian_pw_besar_kecil_khusus', 'cttan_penilaian_ukur_sandi',
        'cttan_penilaian_tampil_sembunyi_sandi', 'cttan_penilaian_valid_email_new_user', 'cttan_penilaian_verif_admin_new_user',
        'cttan_penilaian_exp_password_1_thn', 'cttan_penilaian_user_dibuat_admin', 'cttan_penilaian_reset_pw_user_dibuat_admin',
        'foto_valid_pw_karakter', 'foto_pw_besar_kecil_khusus', 'foto_exp_password',
        'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function getFotoValidPwKarakterAttribute($value)
    {
        return asset('/storage/assessment/otentifikasi/foto_valid_pw_karakter/' . $value);
    }

    public function getFotoPwBesarKecilKhususAttribute($value)
    {
        return asset('/storage/assessment/otentifikasi/foto_pw_besar_kecil_khusus/' . $value);
    }

    public function getFotoExpPasswordAttribute($value)
    {
        return asset('/storage/assessment/otentifikasi/foto_exp_password_thn/' . $value);
    }
}
