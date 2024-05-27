<?php

namespace App\Http\Controllers\Api\Assessment\Assessor;

use App\Models\Manajemen_sesi;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ManajemenSesiController extends Controller
{

    public function index()
    {
        $getData = Manajemen_sesi::with('assessment')->when(request()->q, function ($query) {
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
            'token_url'                         => ['required', Rule::in(['ya', 'tidak'])],
            'manej_sesi'                        => ['required', Rule::in(['ya', 'tidak'])],
            'set_sesi'                          => ['required', Rule::in(['ya', 'tidak'])],
            'back_sesi_out'                     => ['required', Rule::in(['ya', 'tidak'])],
            'aunten_12_jam'                     => ['required', Rule::in(['ya', 'tidak'])],
            'satu_akun_satu_user'               => ['required', Rule::in(['ya', 'tidak'])],
            'satu_akun_berbagai_device'         => ['required', Rule::in(['ya', 'tidak'])],
            'cttan_token_url'                   => ['nullable', 'string'],
            'cttan_manej_sesi'                  => ['nullable', 'string'],
            'cttan_set_sesi'                    => ['nullable', 'string'],
            'cttan_back_sesi_out'               => ['nullable', 'string'],
            'cttan_auten_12_jam'                => ['nullable', 'string'],
            'cttan_satu_akun_satu_user'         => ['nullable', 'string'],
            'cttan_satu_akun_berbagai_device'   => ['nullable', 'string'],
            'foto_manej_sesi'                   => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_set_sesi'                     => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_aunten'                       => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_satu_akun_berbagai_device'    => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'assessment_id'                     => ['required', 'integer'],

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto_manej_sesi = $request->file('foto_manej_sesi');
        $foto_manej_sesi->storeAs('public/assessment/manajemen_sesi/foto_manej_sesi', $foto_manej_sesi->hashName());

        $foto_set_sesi = $request->file('foto_set_sesi');
        $foto_set_sesi->storeAs('public/assessment/manajemen_sesi/foto_set_sesi', $foto_set_sesi->hashName());

        $foto_aunten = $request->file('foto_aunten');
        $foto_aunten->storeAs('public/assessment/manajemen_sesi/foto_aunten', $foto_aunten->hashName());

        $foto_satu_akun_berbagai_device = $request->file('foto_satu_akun_berbagai_device');
        $foto_satu_akun_berbagai_device->storeAs('public/assessment/manajemen_sesi/foto_satu_akun_berbagai_device', $foto_satu_akun_berbagai_device->hashName());

        $data = Manajemen_sesi::create([
            'token_url'                         => $request->token_url,
            'manej_sesi'                        => $request->manej_sesi,
            'set_sesi'                          => $request->set_sesi,
            'back_sesi_out'                     => $request->back_sesi_out,
            'aunten_12_jam'                     => $request->aunten_12_jam,
            'satu_akun_satu_user'               => $request->satu_akun_satu_user,
            'satu_akun_berbagai_device'         => $request->satu_akun_berbagai_device,
            'cttan_token_url'                   => $request->cttan_token_url,
            'cttan_manej_sesi'                  => $request->cttan_manej_sesi,
            'cttan_set_sesi'                    => $request->cttan_set_sesi,
            'cttan_back_sesi_out'               => $request->cttan_back_sesi_out,
            'cttan_auten_12_jam'                => $request->cttan_auten_12_jam,
            'cttan_satu_akun_satu_user'         => $request->cttan_satu_akun_satu_user,
            'cttan_satu_akun_berbagai_device'   => $request->cttan_satu_akun_berbagai_device,
            'foto_manej_sesi'                   => $foto_manej_sesi->hashName(),
            'foto_set_sesi'                     => $foto_set_sesi->hashName(),
            'foto_aunten'                       => $foto_aunten->hashName(),
            'foto_satu_akun_berbagai_device'    => $foto_satu_akun_berbagai_device->hashName(),
            'assessment_id'                     => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal Input', null), 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getData = Manajemen_sesi::with('assessment')->when(request()->q, function ($query) {
            $query->where('assessment_id', 'like', '%' . request()->q . '%');
        })->findOrFail($id);

        if (!$getData) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }


    public function update(Request $request, $id)
    {
        $data = Manajemen_sesi::with('assessment')->when(request()->q, function ($query) {
            $query->where('assessment_id', 'like', '%' . request()->q . '%');
        })->findOrFail($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $validator = Validator::make(request()->all(), [
            'token_url'                         => ['required', Rule::in(['ya', 'tidak'])],
            'manej_sesi'                        => ['required', Rule::in(['ya', 'tidak'])],
            'set_sesi'                          => ['required', Rule::in(['ya', 'tidak'])],
            'back_sesi_out'                     => ['required', Rule::in(['ya', 'tidak'])],
            'aunten_12_jam'                     => ['required', Rule::in(['ya', 'tidak'])],
            'satu_akun_satu_user'               => ['required', Rule::in(['ya', 'tidak'])],
            'satu_akun_berbagai_device'         => ['required', Rule::in(['ya', 'tidak'])],
            'cttan_token_url'                   => ['nullable', 'string'],
            'cttan_manej_sesi'                  => ['nullable', 'string'],
            'cttan_set_sesi'                    => ['nullable', 'string'],
            'cttan_back_sesi_out'               => ['nullable', 'string'],
            'cttan_auten_12_jam'                => ['nullable', 'string'],
            'cttan_satu_akun_satu_user'         => ['nullable', 'string'],
            'cttan_satu_akun_berbagai_device'   => ['nullable', 'string'],
            'foto_manej_sesi'                   => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_set_sesi'                     => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_aunten'                       => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_satu_akun_berbagai_device'    => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'assessment_id'                     => ['required', 'integer'],

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_manej_sesi/' . basename($data->foto_manej_sesi));
        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_set_sesi/' . basename($data->foto_set_sesi));
        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_aunten/' . basename($data->foto_aunten));
        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_satu_akun_berbagai_device/' . basename($data->foto_satu_akun_berbagai_device));

        $foto_manej_sesi = $request->file('foto_manej_sesi');
        $foto_manej_sesi->storeAs('public/assessment/manajemen_sesi/foto_manej_sesi', $foto_manej_sesi->hashName());

        $foto_set_sesi = $request->file('foto_set_sesi');
        $foto_set_sesi->storeAs('public/assessment/manajemen_sesi/foto_set_sesi', $foto_set_sesi->hashName());

        $foto_aunten = $request->file('foto_aunten');
        $foto_aunten->storeAs('public/assessment/manajemen_sesi/foto_aunten', $foto_aunten->hashName());

        $foto_satu_akun_berbagai_device = $request->file('foto_satu_akun_berbagai_device');
        $foto_satu_akun_berbagai_device->storeAs('public/assessment/manajemen_sesi/foto_satu_akun_berbagai_device', $foto_satu_akun_berbagai_device->hashName());

        $data->update([
            'token_url'                         => $request->token_url,
            'manej_sesi'                        => $request->manej_sesi,
            'set_sesi'                          => $request->set_sesi,
            'back_sesi_out'                     => $request->back_sesi_out,
            'aunten_12_jam'                     => $request->aunten_12_jam,
            'satu_akun_satu_user'               => $request->satu_akun_satu_user,
            'satu_akun_berbagai_device'         => $request->satu_akun_berbagai_device,
            'cttan_token_url'                   => $request->cttan_token_url,
            'cttan_manej_sesi'                  => $request->cttan_manej_sesi,
            'cttan_set_sesi'                    => $request->cttan_set_sesi,
            'cttan_back_sesi_out'               => $request->cttan_back_sesi_out,
            'cttan_auten_12_jam'                => $request->cttan_auten_12_jam,
            'cttan_satu_akun_satu_user'         => $request->cttan_satu_akun_satu_user,
            'cttan_satu_akun_berbagai_device'   => $request->cttan_satu_akun_berbagai_device,
            'foto_manej_sesi'                   => $foto_manej_sesi->hashName(),
            'foto_set_sesi'                     => $foto_set_sesi->hashName(),
            'foto_aunten'                       => $foto_aunten->hashName(),
            'foto_satu_akun_berbagai_device'    => $foto_satu_akun_berbagai_device->hashName(),
            'assessment_id'                     => $request->assessment_id,
        ]);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal Update', null), 400);
    }


    public function destroy($id)
    {
        $data = Manajemen_sesi::findOrFail($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_manej_sesi/' . basename($data->foto_manej_sesi));
        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_set_sesi/' . basename($data->foto_set_sesi));
        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_aunten/' . basename($data->foto_aunten));
        Storage::disk('local')->delete('public/assessment/manajemen_sesi/foto_satu_akun_berbagai_device/' . basename($data->foto_satu_akun_berbagai_device));

        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
