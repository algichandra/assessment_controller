<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Dokumen;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Dokumen::all();

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
        $validator = Validator::make($request->all(), [
            'nama_dok'        => ['required', 'string', 'max:150'],
            'dok'             => ['required', 'mimes:pdf', 'max:10000'],
            'assessment_id'   => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $getData = Dokumen::where([
            'nama_dok'      => $request->nama_dok,
            'assessment_id' => $request->assessment_id,
        ])->get();

        if ($getData->count() > 0) {
            return response()->json(new DefaultResource(false, 'Duplicate', $getData), 409);
        }

        $file = $request->file('dok');
        $file->storeAs('public/assessment/dokumen', $file->hashName());

        $data = Dokumen::create([
            'nama_dok'      => $request->nama_dok,
            'dok'           => $file->hashName(),
            'assessment_id' => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diinput', null), 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getData = Dokumen::whereId($id)->first();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Not Found', null), 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_dok'        => ['required', 'string', 'max:150'],
            'dok'             => ['nullable', 'mimes:pdf', 'max:8000'],
            'assessment_id'   => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Dokumen::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        if ($request->file('dok')) {

            Storage::disk('local')->delete('public/assessment/dokumen' . basename($data->dok));

            $file = $request->file('dok');
            $file->storeAs('public/assessment/dokumen', $file->hashName());

            $data->update([
                'nama_dok'      => $request->nama_dok,
                'dok'           => $file->hashName(),
                'assessment_id' => $request->assessment_id,
            ]);

            if ($data) {
                return response()->json(new DefaultResource(true, 'Success', $data), 200);
            }

            return response()->json(new DefaultResource(false, 'Data Gagal diupdate', null), 400);
        }

        $data->update([
            'nama_dok'      => $request->nama_dok,
            'assessment_id' => $request->assessment_id,
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
        $data = Dokumen::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        Storage::disk('local')->delete('public/assessment/dokumen/' . basename($data->dok));
        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
