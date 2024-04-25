<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Apk;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
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
            'nama_kegiatan'     => ['nullable', 'string'],
            'thn_anggaran'      => ['nullable', 'string', 'max:15'],
            'kegiatan_dpa'      => ['required', 'string', 'max:30'],
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
        $data = Apk::create([
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

        if ($data) {
            return response()->json(new DefaultResource(true, 'success', $data), 200);
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
            'nama_kegiatan'     => ['nullable', 'string'],
            'thn_anggaran'      => ['nullable', 'string', 'max:15'],
            'kegiatan_dpa'      => ['required', 'string', 'max:30'],
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
