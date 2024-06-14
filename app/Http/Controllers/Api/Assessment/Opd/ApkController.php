<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Apk;
use App\Models\Opd;
use App\Models\Developer;
use App\Models\Programer;
use App\Models\Assessment;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class ApkController extends Controller
{
    public function index()
    {
        $getData = Apk::with('opd', 'user_apk', 'jenis_kegiatan', 'developer', 'programer')->when(request()->q, function ($query) {
            $query->where('nama_apk', 'like', '%' . request()->q . '%');
        })->get();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, 'No Content', null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_apk'          => ['required', 'string', 'max:150'],
            'nama_kegiatan'     => ['nullable', 'string', 'max:150'],
            'thn_anggaran'      => ['nullable', 'string', 'max:15'],
            'kegiatan_dpa'      => ['required', Rule::in(['dpa', 'non_dpa'])],
            'pj'                => ['required', 'string', 'max:150'],
            'user_id'            => ['required', 'integer'],
            'user_apk_id'       => ['required', 'integer'],
            'jenis_kegiatan_id' => ['required', 'integer'],

            'nama_perusahaan'     => ['required', 'string', 'max:150'],
            'nama_pj'             => ['required', 'string', 'max:150'],
            'alamat_developer'    => ['required', 'string'],
            'telp_developer'      => ['required', 'string', 'max:20'],
            'email_developer'     => ['required', 'string', 'max:30'],

            'nama_programer'     => ['required', 'string', 'max:150'],
            'alamat_programer'   => ['required', 'string'],
            'telp_programer'     => ['required', 'string', 'max:20'],
            'email_programer'    => ['required', 'string', 'max:30'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $getData = Apk::where([
            'nama_apk'              => $request->nama_apk,
            'nama_kegiatan'         => $request->nama_kegiatan,
            'thn_anggaran'          => $request->thn_anggaran,
            'kegiatan_dpa'          => $request->kegiatan_dpa,
            'cttan_dpa'             => $request->cttan_dpa,
            'pj'                    => $request->pj,
            'opd_id'                => $request->opd_id,
            'user_apk_id'           => $request->user_apk_id,
            'jenis_kegiatan_id'     => $request->jenis_kegiatan_id,
            'developer_id'          => $request->developer_id,
            'programer_id'          => $request->programer_id,
        ])->get();

        if ($getData->count() > 0) {
            return response()->json(new DefaultResource(false, "Duplikat", $getData), 409);
        }

        $data_developer = Developer::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_pj'         => $request->nama_pj,
            'alamat'          => $request->alamat_developer,
            'telp'            => $request->telp_developer,
            'email'           => $request->email_developer,
        ]);

        $data_programer = Programer::create([
            'nama' => $request->nama_programer,
            'alamat' => $request->alamat_programer,
            'telp' => $request->telp_programer,
            'email' => $request->email_programer,
        ]);

        $getOpdId = Opd::where([
            'user_id' => $request->user_id
        ])->first();

        $data = Apk::create([
            'nama_apk'              => $request->nama_apk,
            'nama_kegiatan'         => $request->nama_kegiatan,
            'thn_anggaran'          => $request->thn_anggaran,
            'kegiatan_dpa'          => $request->kegiatan_dpa,
            'cttan_dpa'             => $request->cttan_dpa,
            'pj'                    => $request->pj,
            'opd_id'                => $getOpdId->id,
            'user_apk_id'           => $request->user_apk_id,
            'jenis_kegiatan_id'     => $request->jenis_kegiatan_id,
            'developer_id'          => $data_developer->id,
            'programer_id'          => $data_programer->id,
        ]);

        $data_assessment = Assessment::create([
            'apk_id'    => $data->id,
            'status_id' => 1,
        ]);
        if ($data) {
            return response()->json(new DefaultResource(true, 'success', ['data' => $data, 'data_assessment' => $data_assessment]), 200);
        }

        return response()->json(new DefaultResource(true, 'Data Gagal diinput', null), 400);
    }

    public function show($id)
    {
        $getData = Apk::with('opd', 'user_apk', 'jenis_kegiatan', 'developer', 'programer')->when(request()->q, function ($query) {
            $query->where('nama_apk', 'like', '%' . request()->q . '%');
        })->whereId($id)->first();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Not Found', null), 404);
    }

    public function update(Request $request, Apk $apk)
    {
        $validator = Validator::make($request->all(), [
            'nama_apk'          => ['required', 'string', 'max:150'],
            'nama_kegiatan'     => ['nullable', 'string', 'max:150'],
            'thn_anggaran'      => ['nullable', 'string', 'max:15'],
            'kegiatan_dpa'      => ['required', Rule::in(['dpa', 'non_dpa'])],
            'cttan_dpa'         => ['nullable', 'string'],
            'pj'                => ['required', 'string', 'max:150'],
            'opd_id'            => ['required', 'integer'],
            'user_apk_id'       => ['required', 'integer'],
            'jenis_kegiatan_id' => ['required', 'integer'],
            'developer_id'      => ['required', 'integer'],
            'programer_id'      => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $apk->update([
            'nama_apk'              => $request->nama_apk,
            'nama_kegiatan'         => $request->nama_kegiatan,
            'thn_anggaran'          => $request->thn_anggaran,
            'kegiatan_dpa'          => $request->kegiatan_dpa,
            'cttan_dpa'             => $request->cttan_dpa,
            'pj'                    => $request->pj,
            'opd_id'                => $request->opd_id,
            'user_apk_id'           => $request->user_apk_id,
            'jenis_kegiatan_id'     => $request->jenis_kegiatan_id,
            'developer_id'          => $request->developer_id,
            'programer_id'          => $request->programer_id,
        ]);

        if ($apk) {
            return response()->json(new DefaultResource(true, 'Success', $apk), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diupdate', null), 400);
    }

    public function destroy(Apk $apk)
    {
        if ($apk->delete()) {
            return response()->json(new DefaultResource(true, 'Success', null), 200);
        }
        return response()->json(new DefaultResource(false, "Data Gagal dihapus", null), 400);
    }
}
