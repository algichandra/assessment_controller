<?php

namespace App\Http\Controllers\Api\Assessment\Admin;

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use Illuminate\Support\Facades\Validator;


class OpdController extends Controller
{
    public function index()
    {
        $getData = Opd::with('user')->when(request()->q, function ($query) {
            $query->where('opd', 'like', '%' . request()->q . '%');
        })->get();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, "No Content", null), 204);
        }

        return response()->json(new DefaultResource(true, "Success", $getData), 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'opd'     => ['required', 'string', 'max:150'],
            'alamat'  => ['required', 'string'],
            'telp'    => ['required', 'string', 'max:15'],
            'email'   => ['required', 'string', 'max:30'],
            'user_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $getData = Opd::where([
            'opd'      => $request->opd,
            'alamat'   => $request->alamat,
            'telp'     => $request->telp,
            'email'    => $request->email,
            'user_id'  => $request->user_id,
        ])->get();

        if ($getData->count() > 0) {
            return response()->json(new DefaultResource(false, "Duplikat", $getData), 409);
        }
        $data = Opd::create([
            'opd'      => $request->opd,
            'alamat'   => $request->alamat,
            'telp'     => $request->telp,
            'email'    => $request->email,
            'user_id'  => $request->user_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'success', $data), 200);
        }

        return response()->json(new DefaultResource(true, 'Data Gagal diinput', null), 400);
    }

    public function show($id)
    {
        $getData = Opd::with('user')->when(request()->q, function ($query) {
            $query->where('opd', 'like', '%' . request()->q . '%');
        })->whereId($id)->first();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Not Found', null), 404);
    }

    public function update(Request $request, Opd $opd)
    {
        $validator = Validator::make($request->all(), [
            'opd'     => ['required', 'string', 'max:150'],
            'alamat'  => ['required', 'string'],
            'telp'    => ['required', 'string', 'max:15'],
            'email'   => ['required', 'string', 'max:30'],
            'user_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $opd->update([
            'opd'      => $request->opd,
            'alamat'   => $request->alamat,
            'telp'     => $request->telp,
            'email'    => $request->email,
            'user_id'  => $request->user_id,
        ]);

        if ($opd) {
            return response()->json(new DefaultResource(true, 'Success', $opd), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diupdate', null), 400);
    }

    public function destroy(Opd $opd)
    {
        if ($opd->delete()) {
            return response()->json(new DefaultResource(true, 'Success', null), 200);
        }
        return response()->json(new DefaultResource(false, "Data Gagal dihapus", null), 400);
    }
}
