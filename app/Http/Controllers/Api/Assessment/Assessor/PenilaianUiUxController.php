<?php

namespace App\Http\Controllers\Api\Assessment\Assessor;

use App\Models\Assessment;
use App\Models\Penilaian_ui_ux;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PenilaianUiUxController extends Controller
{

    public function index()
    {
        $getData = Penilaian_ui_ux::with('assessment')->when(request()->q, function ($query) {
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
            'penilaian_warna'                   => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_logo_kotabgr'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_logo_apk'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_copyright_pemkot'        => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_info_identitasopd'       => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_info_apk'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_faq'                     => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_user_friendly'           => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_fungsionalitas'          => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_dashboard'               => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_log_user'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'cttan_penilaian_warna'             => ['nullable', 'string'],
            'cttan_penilaian_logo_kota'         => ['nullable', 'string'],
            'cttan_penilaian_logo_apk'          => ['nullable', 'string'],
            'cttan_penilaian_cr_pemkot'         => ['nullable', 'string'],
            'cttan_penilaian_identitas_odp'     => ['nullable', 'string'],
            'cttan_penilaian_info_apk'          => ['nullable', 'string'],
            'cttan_penilaian_faq'               => ['nullable', 'string'],
            'cttan_penilaian_uiux_frendly'      => ['nullable', 'string'],
            'cttan_penilaian_fungsionalitas'    => ['nullable', 'string'],
            'cttan_penilaian_dashboard'         => ['nullable', 'string'],
            'cttan_penilaian_log_usr'           => ['nullable', 'string'],
            'assessment_id'                     => ['required', 'integer'],
            'hasil_assessment'                  => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dataAssessment = Assessment::findOrFail($request->assessment_id);

        $dataAssessment->update([
            "status_id" => $request->hasil_assessment
        ]);

        $data = Penilaian_ui_ux::create([
            'penilaian_warna'                   => $request->penilaian_warna,
            'penilaian_logo_kotabgr'            => $request->penilaian_logo_kotabgr,
            'penilaian_logo_apk'                => $request->penilaian_logo_apk,
            'penilaian_copyright_pemkot'        => $request->penilaian_copyright_pemkot,
            'penilaian_info_identitasopd'       => $request->penilaian_info_identitasopd,
            'penilaian_info_apk'                => $request->penilaian_info_apk,
            'penilaian_faq'                     => $request->penilaian_faq,
            'penilaian_user_friendly'           => $request->penilaian_user_friendly,
            'penilaian_fungsionalitas'          => $request->penilaian_fungsionalitas,
            'penilaian_dashboard'               => $request->penilaian_dashboard,
            'penilaian_log_user'                => $request->penilaian_log_user,
            'cttan_penilaian_warna'             => $request->cttan_penilaian_warna,
            'cttan_penilaian_logo_kota'         => $request->cttan_penilaian_logo_kota,
            'cttan_penilaian_logo_apk'          => $request->cttan_penilaian_logo_apk,
            'cttan_penilaian_cr_pemkot'         => $request->cttan_penilaian_cr_pemkot,
            'cttan_penilaian_identitas_odp'     => $request->cttan_penilaian_identitas_odp,
            'cttan_penilaian_info_apk'          => $request->cttan_penilaian_info_apk,
            'cttan_penilaian_faq'               => $request->cttan_penilaian_faq,
            'cttan_penilaian_uiux_frendly'      => $request->cttan_penilaian_uiux_frendly,
            'cttan_penilaian_fungsionalitas'    => $request->cttan_penilaian_fungsionalitas,
            'cttan_penilaian_dashboard'         => $request->cttan_penilaian_dashboard,
            'cttan_penilaian_log_usr'           => $request->cttan_penilaian_log_usr,
            'assessment_id'                     => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diinput', null), 400);
    }


    public function show($id)
    {
        $getData = Penilaian_ui_ux::whereId($id)->first();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Not Found', null), 404);
    }


    public function update(Request $request, $id)
    {
        $data = Penilaian_ui_ux::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $validator = Validator::make(request()->all(), [
            'penilaian_warna'                   => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_logo_kotabgr'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_logo_apk'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_copyright_pemkot'        => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_info_identitasopd'       => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_info_apk'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_faq'                     => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_user_friendly'           => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_fungsionalitas'          => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_dashboard'               => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_log_user'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'cttan_penilaian_warna'             => ['nullable', 'string'],
            'cttan_penilaian_logo_kota'         => ['nullable', 'string'],
            'cttan_penilaian_logo_apk'          => ['nullable', 'string'],
            'cttan_penilaian_cr_pemkot'         => ['nullable', 'string'],
            'cttan_penilaian_identitas_odp'     => ['nullable', 'string'],
            'cttan_penilaian_info_apk'          => ['nullable', 'string'],
            'cttan_penilaian_faq'               => ['nullable', 'string'],
            'cttan_penilaian_uiux_frendly'      => ['nullable', 'string'],
            'cttan_penilaian_fungsionalitas'    => ['nullable', 'string'],
            'cttan_penilaian_dashboard'         => ['nullable', 'string'],
            'cttan_penilaian_log_usr'           => ['nullable', 'string'],
            'assessment_id'                     => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data->update([
            'penilaian_warna'                   => $request->penilaian_warna,
            'penilaian_logo_kotabgr'            => $request->penilaian_logo_kotabgr,
            'penilaian_logo_apk'                => $request->penilaian_logo_apk,
            'penilaian_copyright_pemkot'        => $request->penilaian_copyright_pemkot,
            'penilaian_info_identitasopd'       => $request->penilaian_info_identitasopd,
            'penilaian_info_apk'                => $request->penilaian_info_apk,
            'penilaian_faq'                     => $request->penilaian_faq,
            'penilaian_user_friendly'           => $request->penilaian_user_friendly,
            'penilaian_fungsionalitas'          => $request->penilaian_fungsionalitas,
            'penilaian_dashboard'               => $request->penilaian_dashboard,
            'penilaian_log_user'                => $request->penilaian_log_user,
            'cttan_penilaian_warna'             => $request->cttan_penilaian_warna,
            'cttan_penilaian_logo_kota'         => $request->cttan_penilaian_logo_kota,
            'cttan_penilaian_logo_apk'          => $request->cttan_penilaian_logo_apk,
            'cttan_penilaian_cr_pemkot'         => $request->cttan_penilaian_cr_pemkot,
            'cttan_penilaian_identitas_odp'     => $request->cttan_penilaian_identitas_odp,
            'cttan_penilaian_info_apk'          => $request->cttan_penilaian_info_apk,
            'cttan_penilaian_faq'               => $request->cttan_penilaian_faq,
            'cttan_penilaian_uiux_frendly'      => $request->cttan_penilaian_uiux_frendly,
            'cttan_penilaian_fungsionalitas'    => $request->cttan_penilaian_fungsionalitas,
            'cttan_penilaian_dashboard'         => $request->cttan_penilaian_dashboard,
            'cttan_penilaian_log_usr'           => $request->cttan_penilaian_log_usr,
            'assessment_id'                     => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diupdate', null), 400);
    }


    public function destroy($id)
    {
        $data = Penilaian_ui_ux::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
