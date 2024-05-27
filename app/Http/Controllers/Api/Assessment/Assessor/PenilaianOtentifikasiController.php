<?php

namespace App\Http\Controllers\Api\Assessment\Assessor;

use App\Http\Controllers\Controller;
use App\Models\Penilaian_otentifikasi;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PenilaianOtentifikasiController extends Controller
{

    public function index()
    {
        $getData = Penilaian_otentifikasi::with('assessment')->when(request()->q, function ($query) {
            $query->where('assessment_id', 'like', '%' . request()->q . '%');
        })->get();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, 'No Content', null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'penilaian_login'                               => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_captcha_login'                       => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_cpatcha_lain'                        => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_daftar'                              => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_reset_password'                      => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_password_8_krtr'                     => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_password_besar_kecil_khusus'         => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_ukur_sandi'                          => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_tampil_sembunyi_sandi'               => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_valid_email_new_user'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_verif_admin_new_user'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_exp_password_1_thn'                  => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_user_dibuat_admin'                   => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_reset_password_user_dibuat_admin'    => ['required', Rule::in(['sesuai', 'tidak'])],
            'cttan_penilaian_login'                         => ['nullable', 'string'],
            'cttan_penilaian_captcha_login'                 => ['nullable', 'string'],
            'cttan_penilaian_captcha_lain'                  => ['nullable', 'string'],
            'cttan_penilaian_daftar'                        => ['nullable', 'string'],
            'cttan_penilaian_reset_password'                => ['nullable', 'string'],
            'cttan_penilaian_valid_pw_8_karakter'           => ['nullable', 'string'],
            'cttan_penilaian_pw_besar_kecil_khusus'         => ['nullable', 'string'],
            'cttan_penilaian_ukur_sandi'                    => ['nullable', 'string'],
            'cttan_penilaian_tampil_sembunyi_sandi'         => ['nullable', 'string'],
            'cttan_penilaian_valid_email_new_user'          => ['nullable', 'string'],
            'cttan_penilaian_verif_admin_new_user'          => ['nullable', 'string'],
            'cttan_penilaian_exp_password_1_thn'            => ['nullable', 'string'],
            'cttan_penilaian_user_dibuat_admin'             => ['nullable', 'string'],
            'cttan_penilaian_reset_pw_user_dibuat_admin'    => ['nullable', 'string'],
            'foto_valid_pw_karakter'                        => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_pw_besar_kecil_khusus'                    => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_exp_password'                             => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'assessment_id'                                 => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto_valid_pw_karakter = $request->file('foto_valid_pw_karakter');
        $foto_valid_pw_karakter->storeAs('public/assessment/otentifikasi/foto_valid_pw_karakter', $foto_valid_pw_karakter->hashName());

        $foto_pw_besar_kecil_khusus = $request->file('foto_pw_besar_kecil_khusus');
        $foto_pw_besar_kecil_khusus->storeAs('public/assessment/otentifikasi/foto_pw_besar_kecil_khusus', $foto_pw_besar_kecil_khusus->hashName());

        $foto_exp_password = $request->file('foto_exp_password');
        $foto_exp_password->storeAs('public/assessment/otentifikasi/foto_exp_password', $foto_exp_password->hashName());

        $data = Penilaian_otentifikasi::create([
            'penilaian_login'                               => $request->penilaian_login,
            'penilaian_captcha_login'                       => $request->penilaian_captcha_login,
            'penilaian_cpatcha_lain'                        => $request->penilaian_cpatcha_lain,
            'penilaian_daftar'                              => $request->penilaian_daftar,
            'penilaian_reset_password'                      => $request->penilaian_reset_password,
            'penilaian_password_8_krtr'                     => $request->penilaian_password_8_krtr,
            'penilaian_password_besar_kecil_khusus'         => $request->penilaian_password_besar_kecil_khusus,
            'penilaian_ukur_sandi'                          => $request->penilaian_ukur_sandi,
            'penilaian_tampil_sembunyi_sandi'               => $request->penilaian_tampil_sembunyi_sandi,
            'penilaian_valid_email_new_user'                => $request->penilaian_valid_email_new_user,
            'penilaian_verif_admin_new_user'                => $request->penilaian_verif_admin_new_user,
            'penilaian_exp_password_1_thn'                  => $request->penilaian_exp_password_1_thn,
            'penilaian_user_dibuat_admin'                   => $request->penilaian_user_dibuat_admin,
            'penilaian_reset_password_user_dibuat_admin'    => $request->penilaian_reset_password_user_dibuat_admin,
            'cttan_penilaian_login'                         => $request->cttan_penilaian_login,
            'cttan_penilaian_captcha_login'                 => $request->cttan_penilaian_captcha_login,
            'cttan_penilaian_captcha_lain'                  => $request->cttan_penilaian_captcha_lain,
            'cttan_penilaian_daftar'                        => $request->cttan_penilaian_daftar,
            'cttan_penilaian_reset_password'                => $request->cttan_penilaian_reset_password,
            'cttan_penilaian_valid_pw_8_karakter'           => $request->cttan_penilaian_valid_pw_8_karakter,
            'cttan_penilaian_pw_besar_kecil_khusus'         => $request->cttan_penilaian_pw_besar_kecil_khusus,
            'cttan_penilaian_ukur_sandi'                    => $request->cttan_penilaian_ukur_sandi,
            'cttan_penilaian_tampil_sembunyi_sandi'         => $request->cttan_penilaian_tampil_sembunyi_sandi,
            'cttan_penilaian_valid_email_new_user'          => $request->cttan_penilaian_valid_email_new_user,
            'cttan_penilaian_verif_admin_new_user'          => $request->cttan_penilaian_verif_admin_new_user,
            'cttan_penilaian_exp_password_1_thn'            => $request->cttan_penilaian_exp_password_1_thn,
            'cttan_penilaian_user_dibuat_admin'             => $request->cttan_penilaian_user_dibuat_admin,
            'cttan_penilaian_reset_pw_user_dibuat_admin'    => $request->cttan_penilaian_reset_pw_user_dibuat_admin,
            'foto_valid_pw_karakter'                        => $foto_valid_pw_karakter->hashName(),
            'foto_pw_besar_kecil_khusus'                    => $foto_pw_besar_kecil_khusus->hashName(),
            'foto_exp_password'                             => $foto_exp_password->hashName(),
            'assessment_id'                                 => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal Input', null), 400);
    }


    public function show($id)
    {
        $getData = Penilaian_otentifikasi::with('assessment')->when(request()->q, function ($query) {
            $query->where('assessment_id', 'like', '%' . request()->q . '%');
        })->findOrFail($id);

        if (!$getData) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }


    public function update(Request $request, $id)
    {
        $data = Penilaian_otentifikasi::with('assessment')->when(request()->q, function ($query) {
            $query->where('assessment_id', 'like', '%' . request()->q . '%');
        })->findOrFail($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $validator = Validator::make(request()->all(), [
            'penilaian_login'                               => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_captcha_login'                       => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_cpatcha_lain'                        => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_daftar'                              => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_reset_password'                      => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_password_8_krtr'                     => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_password_besar_kecil_khusus'         => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_ukur_sandi'                          => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_tampil_sembunyi_sandi'               => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_valid_email_new_user'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_verif_admin_new_user'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_exp_password_1_thn'                  => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_user_dibuat_admin'                   => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_reset_password_user_dibuat_admin'    => ['required', Rule::in(['sesuai', 'tidak'])],
            'cttan_penilaian_login'                         => ['nullable', 'string'],
            'cttan_penilaian_captcha_login'                 => ['nullable', 'string'],
            'cttan_penilaian_captcha_lain'                  => ['nullable', 'string'],
            'cttan_penilaian_daftar'                        => ['nullable', 'string'],
            'cttan_penilaian_reset_password'                => ['nullable', 'string'],
            'cttan_penilaian_valid_pw_8_karakter'           => ['nullable', 'string'],
            'cttan_penilaian_pw_besar_kecil_khusus'         => ['nullable', 'string'],
            'cttan_penilaian_ukur_sandi'                    => ['nullable', 'string'],
            'cttan_penilaian_tampil_sembunyi_sandi'         => ['nullable', 'string'],
            'cttan_penilaian_valid_email_new_user'          => ['nullable', 'string'],
            'cttan_penilaian_verif_admin_new_user'          => ['nullable', 'string'],
            'cttan_penilaian_exp_password_1_thn'            => ['nullable', 'string'],
            'cttan_penilaian_user_dibuat_admin'             => ['nullable', 'string'],
            'cttan_penilaian_reset_pw_user_dibuat_admin'    => ['nullable', 'string'],
            'foto_valid_pw_karakter'                        => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_pw_besar_kecil_khusus'                    => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_exp_password'                             => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'assessment_id'                                 => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Storage::disk('local')->delete('public/assessment/otentifikasi/foto_valid_pw_karakter/' . basename($data->foto_valid_pw_karakter));
        Storage::disk('local')->delete('public/assessment/otentifikasi/foto_pw_besar_kecil_khusus/' . basename($data->foto_pw_besar_kecil_khusus));
        Storage::disk('local')->delete('public/assessment/otentifikasi/foto_exp_password/' . basename($data->foto_exp_password));

        $foto_valid_pw_karakter = $request->file('foto_valid_pw_karakter');
        $foto_valid_pw_karakter->storeAs('public/assessment/otentifikasi/foto_valid_pw_karakter', $foto_valid_pw_karakter->hashName());

        $foto_pw_besar_kecil_khusus = $request->file('foto_pw_besar_kecil_khusus');
        $foto_pw_besar_kecil_khusus->storeAs('public/assessment/otentifikasi/foto_pw_besar_kecil_khusus', $foto_pw_besar_kecil_khusus->hashName());

        $foto_exp_password = $request->file('foto_exp_password');
        $foto_exp_password->storeAs('public/assessment/otentifikasi/foto_exp_password', $foto_exp_password->hashName());

        $data->update([
            'penilaian_login'                               => $request->penilaian_login,
            'penilaian_captcha_login'                       => $request->penilaian_captcha_login,
            'penilaian_cpatcha_lain'                        => $request->penilaian_cpatcha_lain,
            'penilaian_daftar'                              => $request->penilaian_daftar,
            'penilaian_reset_password'                      => $request->penilaian_reset_password,
            'penilaian_password_8_krtr'                     => $request->penilaian_password_8_krtr,
            'penilaian_password_besar_kecil_khusus'         => $request->penilaian_password_besar_kecil_khusus,
            'penilaian_ukur_sandi'                          => $request->penilaian_ukur_sandi,
            'penilaian_tampil_sembunyi_sandi'               => $request->penilaian_tampil_sembunyi_sandi,
            'penilaian_valid_email_new_user'                => $request->penilaian_valid_email_new_user,
            'penilaian_verif_admin_new_user'                => $request->penilaian_verif_admin_new_user,
            'penilaian_exp_password_1_thn'                  => $request->penilaian_exp_password_1_thn,
            'penilaian_user_dibuat_admin'                   => $request->penilaian_user_dibuat_admin,
            'penilaian_reset_password_user_dibuat_admin'    => $request->penilaian_reset_password_user_dibuat_admin,
            'cttan_penilaian_login'                         => $request->cttan_penilaian_login,
            'cttan_penilaian_captcha_login'                 => $request->cttan_penilaian_captcha_login,
            'cttan_penilaian_captcha_lain'                  => $request->cttan_penilaian_captcha_lain,
            'cttan_penilaian_daftar'                        => $request->cttan_penilaian_daftar,
            'cttan_penilaian_reset_password'                => $request->cttan_penilaian_reset_password,
            'cttan_penilaian_valid_pw_8_karakter'           => $request->cttan_penilaian_valid_pw_8_karakter,
            'cttan_penilaian_pw_besar_kecil_khusus'         => $request->cttan_penilaian_pw_besar_kecil_khusus,
            'cttan_penilaian_ukur_sandi'                    => $request->cttan_penilaian_ukur_sandi,
            'cttan_penilaian_tampil_sembunyi_sandi'         => $request->cttan_penilaian_tampil_sembunyi_sandi,
            'cttan_penilaian_valid_email_new_user'          => $request->cttan_penilaian_valid_email_new_user,
            'cttan_penilaian_verif_admin_new_user'          => $request->cttan_penilaian_verif_admin_new_user,
            'cttan_penilaian_exp_password_1_thn'            => $request->cttan_penilaian_exp_password_1_thn,
            'cttan_penilaian_user_dibuat_admin'             => $request->cttan_penilaian_user_dibuat_admin,
            'cttan_penilaian_reset_pw_user_dibuat_admin'    => $request->cttan_penilaian_reset_pw_user_dibuat_admin,
            'foto_valid_pw_karakter'                        => $foto_valid_pw_karakter->hashName(),
            'foto_pw_besar_kecil_khusus'                    => $foto_pw_besar_kecil_khusus->hashName(),
            'foto_exp_password'                             => $foto_exp_password->hashName(),
            'assessment_id'                                 => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal Update', null), 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Penilaian_otentifikasi::with('assessment')->when(request()->q, function ($query) {
            $query->where('assessment_id', 'like', '%' . request()->q . '%');
        })->findOrFail($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        Storage::disk('local')->delete('public/assessment/otentifikasi/foto_valid_pw_8_karakter/' . basename($data->foto_valid_pw_karakter));
        Storage::disk('local')->delete('public/assessment/otentifikasi/foto_pw_besar_kecil_khusus/' . basename($data->foto_pw_besar_kecil_khusus));
        Storage::disk('local')->delete('public/assessment/otentifikasi/foto_exp_password_1_thn/' . basename($data->foto_exp_password));

        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
