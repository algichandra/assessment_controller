<?php

namespace App\Http\Controllers\Api\Assessment\Assessor;

use App\Http\Controllers\Controller;
use App\Models\Penilaian_tata_kelola;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PenilaianTataKelolaController extends Controller
{

    public function index()
    {
        $getData = Penilaian_tata_kelola::all();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, 'No Content', null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'penilaian_dok_kak_tor'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_laporan_dpa'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_sk_pengelola_apk'       => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_sk_helpdesk_apk'        => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_laporan_akhir'        => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_sop'                    => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_panduan_apk'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_link_video_apk'         => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_panduan_apkserver'      => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_dok_mnjresiko'          => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_dok_api'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_file_scapk'             => ['required', Rule::in(['sesuai', 'tidak'])],
            'cttan_penilaian_kak_tor'          => ['nullable', 'string'],
            'cttan_penilaian_lap_awal'         => ['nullable', 'string'],
            'cttan_penilaian_sk_pengelola_apk' => ['nullable', 'string'],
            'cttan_penilaian_sk_helpdesk_apk'  => ['nullable', 'string'],
            'cttan_penilaian_lap_akhir'        => ['nullable', 'string'],
            'cttan_penilaian_sop'              => ['nullable', 'string'],
            'cttan_penilaian_pduan_pnglola'    => ['nullable', 'string'],
            'cttan_penilaian_vid_tutor_apk'    => ['nullable', 'string'],
            'cttan_penilaian_pand_apkserver'   => ['nullable', 'string'],
            'cttan_penilaian_manej_resiko'     => ['nullable', 'string'],
            'cttan_penilaian_dok_api'          => ['nullable', 'string'],
            'cttan_penilaian_source_code'      => ['nullable', 'string'],
            'tata_kelola_id'                   => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Penilaian_tata_kelola::create([
            'penilaian_dok_kak_tor'            => $request->penilaian_dok_kak_tor,
            'penilaian_laporan_dpa'            => $request->penilaian_laporan_dpa,
            'penilaian_sk_pengelola_apk'       => $request->penilaian_sk_pengelola_apk,
            'penilaian_sk_helpdesk_apk'        => $request->penilaian_sk_helpdesk_apk,
            'penilaian_laporan_akhir'          => $request->penilaian_laporan_akhir,
            'penilaian_sop'                    => $request->penilaian_sop,
            'penilaian_panduan_apk'            => $request->penilaian_panduan_apk,
            'penilaian_link_video_apk'         => $request->penilaian_link_video_apk,
            'penilaian_panduan_apkserver'      => $request->penilaian_panduan_apkserver,
            'penilaian_dok_mnjresiko'          => $request->penilaian_dok_mnjresiko,
            'penilaian_dok_api'                => $request->penilaian_dok_api,
            'penilaian_file_scapk'             => $request->penilaian_file_scapk,
            'cttan_penilaian_kak_tor'          => $request->cttan_penilaian_kak_tor,
            'cttan_penilaian_lap_awal'         => $request->cttan_penilaian_lap_awal,
            'cttan_penilaian_sk_pengelola_apk' => $request->cttan_penilaian_sk_pengelola_apk,
            'cttan_penilaian_sk_helpdesk_apk'  => $request->cttan_penilaian_sk_helpdesk_apk,
            'cttan_penilaian_lap_akhir'        => $request->cttan_penilaian_lap_akhir,
            'cttan_penilaian_sop'              => $request->cttan_penilaian_sop,
            'cttan_penilaian_pduan_pnglola'    => $request->cttan_penilaian_pduan_pnglola,
            'cttan_penilaian_vid_tutor_apk'    => $request->cttan_penilaian_vid_tutor_apk,
            'cttan_penilaian_pand_apkserver'   => $request->cttan_penilaian_pand_apkserver,
            'cttan_penilaian_manej_resiko'     => $request->cttan_penilaian_manej_resiko,
            'cttan_penilaian_dok_api'          => $request->cttan_penilaian_dok_api,
            'cttan_penilaian_source_code'      => $request->cttan_penilaian_source_code,
            'tata_kelola_id'                   => $request->tata_kelola_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diinput', null), 400);
    }


    public function show($id)
    {
        $getData = Penilaian_tata_kelola::whereId($id)->first();

        if (!$getData) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }

    public function update(Request $request, $id)
    {
        $data = Penilaian_tata_kelola::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $validator = Validator::make(request()->all(), [
            'penilaian_dok_kak_tor'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_laporan_dpa'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_sk_pengelola_apk'       => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_sk_helpdesk_apk'        => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_sop'                    => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_panduan_apk'            => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_link_video_apk'         => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_panduan_apkserver'      => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_dok_mnjresiko'          => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_dok_api'                => ['required', Rule::in(['sesuai', 'tidak'])],
            'penilaian_file_scapk'             => ['required', Rule::in(['sesuai', 'tidak'])],
            'cttan_penilaian_kak_tor'          => ['nullable', 'string'],
            'cttan_penilaian_lap_awal'         => ['nullable', 'string'],
            'cttan_penilaian_sk_pengelola_apk' => ['nullable', 'string'],
            'cttan_penilaian_sk_helpdesk_apk'  => ['nullable', 'string'],
            'cttan_penilaian_lap_akhir'        => ['nullable', 'string'],
            'cttan_penilaian_sop'              => ['nullable', 'string'],
            'cttan_penilaian_pduan_pnglola'    => ['nullable', 'string'],
            'cttan_penilaian_vid_tutor_apk'    => ['nullable', 'string'],
            'cttan_penilaian_pand_apkserver'   => ['nullable', 'string'],
            'cttan_penilaian_manej_resiko'     => ['nullable', 'string'],
            'cttan_penilaian_dok_api'          => ['nullable', 'string'],
            'cttan_penilaian_source_code'      => ['nullable', 'string'],
            'tata_kelola_id'                   => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data->update([
            'penilaian_dok_kak_tor'            => $request->penilaian_dok_kak_tor,
            'penilaian_laporan_dpa'            => $request->penilaian_laporan_dpa,
            'penilaian_sk_pengelola_apk'       => $request->penilaian_sk_pengelola_apk,
            'penilaian_sk_helpdesk_apk'        => $request->penilaian_sk_helpdesk_apk,
            'penilaian_sop'                    => $request->penilaian_sop,
            'penilaian_panduan_apk'            => $request->penilaian_panduan_apk,
            'penilaian_link_video_apk'         => $request->penilaian_link_video_apk,
            'penilaian_panduan_apkserver'      => $request->penilaian_panduan_apkserver,
            'penilaian_dok_mnjresiko'          => $request->penilaian_dok_mnjresiko,
            'penilaian_dok_api'                => $request->penilaian_dok_api,
            'penilaian_file_scapk'             => $request->penilaian_file_scapk,
            'cttan_penilaian_kak_tor'          => $request->cttan_penilaian_kak_tor,
            'cttan_penilaian_lap_awal'         => $request->cttan_penilaian_lap_awal,
            'cttan_penilaian_sk_pengelola_apk' => $request->cttan_penilaian_sk_pengelola_apk,
            'cttan_penilaian_sk_helpdesk_apk'  => $request->cttan_penilaian_sk_helpdesk_apk,
            'cttan_penilaian_lap_akhir'        => $request->cttan_penilaian_lap_akhir,
            'cttan_penilaian_sop'              => $request->cttan_penilaian_sop,
            'cttan_penilaian_pduan_pnglola'    => $request->cttan_penilaian_pduan_pnglola,
            'cttan_penilaian_vid_tutor_apk'    => $request->cttan_penilaian_vid_tutor_apk,
            'cttan_penilaian_pand_apkserver'   => $request->cttan_penilaian_pand_apkserver,
            'cttan_penilaian_manej_resiko'     => $request->cttan_penilaian_manej_resiko,
            'cttan_penilaian_dok_api'          => $request->cttan_penilaian_dok_api,
            'cttan_penilaian_source_code'      => $request->cttan_penilaian_source_code,
            'tata_kelola_id'                   => $request->tata_kelola_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diupdate', null), 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Penilaian_tata_kelola::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
