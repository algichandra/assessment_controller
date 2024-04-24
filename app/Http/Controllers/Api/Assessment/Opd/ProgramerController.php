<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Programer;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProgramerController extends Controller
{
    public function index()
    {
        $getData = Programer::all();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, "No Content", null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => ['required', 'string', 'max:150'],
            'alamat'   => ['required', 'string'],
            'telp'     => ['required', 'string', 'max:20'],
            'email'    => ['required', 'string', 'max:30'],

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $getData = Programer::where([
            'nama' => $request->name,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
        ])->get();

        if ($getData->count() > 0) {
            return response()->json(new DefaultResource(false, 'Duplicate', $getData), 409);
        }

        $data = Programer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diinput', null), 400);
    }

    public function show($id)
    {
        $getData = Programer::whereId($id)->firt();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Not Found', null), 404);
    }

    public function update(Request $request, Programer $programer)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => ['required', 'string', 'max:150'],
            'alamat'   => ['required', 'string'],
            'telp'     => ['required', 'string', 'max:20'],
            'email'    => ['required', 'string', 'max:30'],

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $programer->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
        ]);

        if ($programer) {
            return response()->json(new DefaultResource(true, 'Success', $programer), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diupdate', null), 400);
    }

    public function destroy(Programer $programer)
    {
        if ($programer->delete()) {
            return response()->json(new DefaultResource(true, 'Success', null), 200);
        }
        return response()->json(new DefaultResource(false, 'Data Gagal dihapus', null), 400);
    }
}
