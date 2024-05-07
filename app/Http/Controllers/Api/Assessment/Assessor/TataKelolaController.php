<?php

namespace App\Http\Controllers\Api\Assessment\Assessor;

use App\Models\Tata_kelola;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TataKelolaController extends Controller
{

    public function index()
    {
        $getData = Tata_kelola::with('assessment')->when(request()->q, function ($query) {
            $query->where('file_scapk', 'like', '%' . request()->q . '%');
        })->get();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, 'No Content', null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dok_kak_tor'       => ['required', 'mimes:pdf', 'max:10000'],
            'laporan_dpa'       => ['nullable', 'mimes:pdf', 'max:10000'],
            'sk_pengelola_apk'  => ['required', 'mimes:pdf', 'max:10000'],
            'sk_helpdesk_apk'   => ['required', 'mimes:pdf', 'max:10000'],
            'laporan_akhir'     => ['required', 'mimes:pdf', 'max:10000'],
            'sop'               => ['required', 'mimes:pdf', 'max:10000'],
            'panduan_apk'       => ['required', 'mimes:pdf', 'max:10000'],
            'link_video_apk'    => ['required', 'string', 'max:250'],
            'panduan_apkserver' => ['required', 'mimes:pdf', 'max:10000'],
            'dok_mnjresiko'     => ['required', 'mimes:pdf', 'max:10000'],
            'dok_api'           => ['required', 'mimes:pdf', 'max:10000'],
            'file_scapk'        => ['required', 'mimes:pdf', 'max:10000'],
            'assessment_id'     => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dok_kak_tor = $request->file('dok_kak_tor');
        $dok_kak_tor->storeAs('public/assessment/tata_kelola/dok_kak_tor', $dok_kak_tor->hashName());

        $laporan_dpa = null;
        if ($request->file('laporan_dpa')) {
            $laporan_dpa = $request->file('laporan_dpa');
            $laporan_dpa->storeAs('public/assessment/tata_kelola/laporan_dpa', $laporan_dpa->hashName());
        }

        $sk_pengelola_apk = $request->file('sk_pengelola_apk');
        $sk_pengelola_apk->storeAs('public/assessment/tata_kelola/sk_pengelola_apk', $sk_pengelola_apk->hashName());

        $sk_helpdesk_apk = $request->file('sk_helpdesk_apk');
        $sk_helpdesk_apk->storeAs('public/assessment/tata_kelola/sk_helpdesk_apk', $sk_helpdesk_apk->hashName());

        $laporan_akhir = $request->file('laporan_akhir');
        $laporan_akhir->storeAs('public/assessment/tata_kelola/laporan_akhir', $laporan_akhir->hashName());

        $sop = $request->file('sop');
        $sop->storeAs('public/assessment/tata_kelola/sop', $sop->hashName());

        $panduan_apk = $request->file('panduan_apk');
        $panduan_apk->storeAs('public/assessment/tata_kelola/panduan_apk', $panduan_apk->hashName());

        $panduan_apkserver = $request->file('panduan_apkserver');
        $panduan_apkserver->storeAs('public/assessment/tata_kelola/panduan_apkserver', $panduan_apkserver->hashName());

        $dok_mnjresiko = $request->file('dok_mnjresiko');
        $dok_mnjresiko->storeAs('public/assessment/tata_kelola/dok_mnjresiko', $dok_mnjresiko->hashName());

        $dok_api = $request->file('dok_api');
        $dok_api->storeAs('public/assessment/tata_kelola/dok_api', $dok_api->hashName());

        $file_scapk = $request->file('file_scapk');
        $file_scapk->storeAs('public/assessment/tata_kelola/file_scapk', $file_scapk->hashName());

        $data = Tata_kelola::create([
            'dok_kak_tor'       => $dok_kak_tor->hashName(),
            'laporan_dpa'       => $laporan_dpa ? $laporan_dpa->hashName() : null,
            'sk_pengelola_apk'  => $sk_pengelola_apk->hashName(),
            'sk_helpdesk_apk'   => $sk_helpdesk_apk->hashName(),
            'laporan_akhir'     => $laporan_akhir->hashName(),
            'sop'               => $sop->hashName(),
            'panduan_apk'       => $panduan_apk->hashName(),
            'link_video_apk'    => $request->link_video_apk,
            'panduan_apkserver' => $panduan_apkserver->hashName(),
            'dok_mnjresiko'     => $dok_mnjresiko->hashName(),
            'dok_api'           => $dok_api->hashName(),
            'file_scapk'        => $file_scapk->hashName(),
            'assessment_id'     => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diinput', null), 400);
    }

    public function show($id)
    {
        $getData = Tata_kelola::with('assessment')->where(request()->q, function ($query) {
            $query->when('file_scapk', 'like', '%' . request()->q . '%');
        })->whereId($id)->first();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Not Found', null), 404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dok_kak_tor'       => ['nullable', 'mimes:pdf', 'max:10000'],
            'laporan_dpa'       => ['nullable', 'mimes:pdf', 'max:10000'],
            'sk_pengelola_apk'  => ['nullable', 'mimes:pdf', 'max:10000'],
            'sk_helpdesk_apk'   => ['nullable', 'mimes:pdf', 'max:10000'],
            'laporan_akhir'     => ['nullable', 'mimes:pdf', 'max:10000'],
            'sop'               => ['nullable', 'mimes:pdf', 'max:10000'],
            'panduan_apk'       => ['nullable', 'mimes:pdf', 'max:10000'],
            'link_video_apk'    => ['required', 'string', 'max:250'],
            'panduan_apkserver' => ['nullable', 'mimes:pdf', 'max:10000'],
            'dok_mnjresiko'     => ['nullable', 'mimes:pdf', 'max:10000'],
            'dok_api'           => ['nullable', 'mimes:pdf', 'max:10000'],
            'file_scapk'        => ['nullable', 'mimes:pdf', 'max:10000'],
            'assessment_id'     => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Tata_kelola::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $fieldsToUpdate = [];

        // Handle file uploads and update fields
        $fileFields = [
            'dok_kak_tor', 'laporan_dpa', 'sk_pengelola_apk', 'sk_helpdesk_apk', 'laporan_akhir',
            'sop', 'panduan_apk', 'panduan_apkserver', 'dok_mnjresiko', 'dok_api', 'file_scapk'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $file->hashName();
                Storage::disk('public')->delete('assessment/tata_kelola/' . $field . '/' . basename($data->$field));
                $file->storeAs('public/assessment/tata_kelola/' . $field, $filename);
                $fieldsToUpdate[$field] = $filename;
            }
        }

        // Update other fields
        $fieldsToUpdate['link_video_apk'] = $request->link_video_apk;
        $fieldsToUpdate['assessment_id'] = $request->assessment_id;

        // Perform the update
        $data->update($fieldsToUpdate);


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
        $data = Tata_kelola::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $fileFields = [
            'dok_kak_tor', 'laporan_dpa', 'sk_pengelola_apk', 'sk_helpdesk_apk', 'laporan_akhir',
            'sop', 'panduan_apk', 'panduan_apkserver', 'dok_mnjresiko', 'dok_api', 'file_scapk'
        ];

        foreach ($fileFields as $field) {
            if ($data->$field) {
                Storage::disk('public')->delete('assessment/tata_kelola/' . $field . '/' . basename($data->$field));
            }
        }

        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
