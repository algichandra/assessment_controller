<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use Illuminate\Support\Facades\Validator;


class DeveloperController extends Controller
{
    public function index()
    {
        $getData = Developer::all();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, "No Content", null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'     => ['required', 'string', 'max:150'],
            'nama_pj'             => ['required', 'string', 'max:150'],
            'alamat'              => ['required', 'string'],
            'telp'                => ['required', 'string', 'max:20'],
            'email'               => ['required', 'string', 'max:30'],

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $getData = Developer::where([
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_pj'         => $request->nama_pj,
            'alamat'          => $request->alamat,
            'telp'            => $request->telp,
            'email'           => $request->email,
        ])->get();

        if ($getData->coount() > 0) {
            return response()->json(new DefaultResource(false, 'Duplicate', $getData), 409);
        }

        $data = Developer::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_pj'         => $request->nama_pj,
            'alamat'          => $request->alamat,
            'telp'            => $request->telp,
            'email'           => $request->email,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diinput', $data), 400);
    }

    public function show($id)
    {
        $getData = Developer::whereId($id)->first();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Not Found', null), 404);
    }

    public function update(Request $request, Developer $developer)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'     => ['required', 'string', 'max:150'],
            'nama_pj'             => ['required', 'string', 'max:150'],
            'alamat'              => ['required', 'string'],
            'telp'                => ['required', 'string', 'max:20'],
            'email'               => ['required', 'string', 'max:30'],

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $developer->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_pj'         => $request->nama_pj,
            'alamat'          => $request->alamat,
            'telp'            => $request->telp,
            'email'           => $request->email,
        ]);

        if ($developer) {
            return response()->json(new DefaultResource(true, 'Success', $developer), 200);
        }

        return response()->json(new DefaultResource(false, "Data Gagal diupdate", null), 400);
    }

    public function destroy(Developer $developer)
    {
        if ($developer->delete()) {
            return response()->json(new DefaultResource(true, 'Success', null), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal dihapus', null), 400);
    }
}
