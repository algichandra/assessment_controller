<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Assessment;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssessmentController extends Controller
{
    public function index()
    {
        $getData = Assessment::with('apk', 'status')->when(request()->q, function ($query) {
            $query->where('apk_id', 'like', '%' . request()->q . '%');
        })->get();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(true, 'No Content', null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'apk_id'            => ['required', 'integer'],
            'status_id'       => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $getData = Assessment::where([
            'apk_id' => $request->apk_id,
            'status_id' => $request->status_id
        ])->get();

        if ($getData->count() > 0) {
            return response()->json(new DefaultResource(false, 'Duplicate', $getData), 409);
        }

        $data = Assessment::create([
            'apk_id' => $request->apk_id,
            'status_id' => $request->status_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diinput', null), 400);
    }

    public function show($id)
    {
        $getData = Assessment::with('apk', 'status')->when(request()->q, function ($query) {
            $query->where('apk_id', 'like', '%' . request()->q . '%');
        })->whereId($id)->first();

        if ($getData) {
            return response()->json(new DefaultResource(true, 'Success', $getData), 200);
        }

        return response()->json(new DefaultResource(false, 'Not Found', null), 404);
    }

    public function update(Request $request, Assessment $assessment)
    {
        $validator = Validator::make($request->all(), [
            'apk_id'            => ['required', 'integer'],
            'status_id'       => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $assessment->update([
            'apk_id' => $request->apk_id,
            'status_id' => $request->status_id,
        ]);

        if ($assessment) {
            return response()->json(new DefaultResource(true, 'Success', $assessment), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal diupdate', null), 400);
    }

    public function destroy(Assessment $assessment)
    {
        if ($assessment->delete()) {
            return response()->json(new DefaultResource(true, 'Success', null), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal dihapus', null), 400);
    }
}
