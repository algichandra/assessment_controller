<?php

namespace App\Http\Controllers\Api\Assessment\Assessor;

use App\Models\Kontrol_akses;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KontrolAksesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Kontrol_akses::with('assessment')->when(request()->q, function ($query) {
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
            'user_lvl_manej'                => ['required', Rule::in(['ya', 'tidak'])],
            'dshbrd_admin'                  => ['required', Rule::in(['ya', 'tidak'])],
            'verif_token'                   => ['required', Rule::in(['ya', 'tidak'])],
            'anti_csrf'                     => ['required', Rule::in(['ya', 'tidak'])],
            'pnjelajah_dirt'                => ['required', Rule::in(['ya', 'tidak'])],
            'cttan_user_lvl_manej'          => ['nullable', 'string'],
            'cttan_dshbrd_admin'            => ['nullable', 'string'],
            'cttan_verif_token'             => ['nullable', 'string'],
            'cttan_anti_csrf'               => ['nullable', 'string'],
            'cttan_pnjelajah_dirt'          => ['nullable', 'string'],
            'foto_data_validasi'            => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_dashbrd_admin'            => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_anti_csrf'                => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_penjelajahan_direktori'   => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'assessment_id'                 => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $fieldToCreate = [];

        $fotoFields = [
            'foto_data_validasi', 'foto_dashbrd_admin', 'foto_anti_csrf', 'foto_penjelajahan_direktori'
        ];

        foreach ($fotoFields as $fields) {
            $foto = $request->file($fields);
            $fotoName = $foto->hashName();
            $foto->storeAs('public/assessment/kontrol_akses/' . $fields, $fotoName);
            $fieldToCreate[$fields] = $fotoName;
        }

        $fieldToCreate['user_lvl_manej']        = $request->user_lvl_manej;
        $fieldToCreate['dshbrd_admin']          = $request->dshbrd_admin;
        $fieldToCreate['verif_token']           = $request->verif_token;
        $fieldToCreate['anti_csrf']             = $request->anti_csrf;
        $fieldToCreate['pnjelajah_dirt']        = $request->pnjelajah_dirt;
        $fieldToCreate['cttan_user_lvl_manej']  = $request->cttan_user_lvl_manej;
        $fieldToCreate['cttan_dshbrd_admin']    = $request->cttan_dshbrd_admin;
        $fieldToCreate['cttan_verif_token']     = $request->cttan_verif_token;
        $fieldToCreate['cttan_anti_csrf']       = $request->cttan_anti_csrf;
        $fieldToCreate['cttan_pnjelajah_dirt']  = $request->cttan_pnjelajah_dirt;
        $fieldToCreate['assessment_id']         = $request->assessment_id;

        $data = Kontrol_akses::create($fieldToCreate);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal Input', null), 400);
    }


    public function show($id)
    {
        $getData = Kontrol_akses::with('assessment')->when(request()->q, function ($query) {
            $query->where('assessment_id', 'like', '%' . request()->q . '%');
        })->findOrFail($id);

        if (!$getData) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }


    public function update(Request $request, $id)
    {
        $data = Kontrol_akses::findOrFail($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $validator = Validator::make(request()->all(), [
            'user_lvl_manej'                => ['required', Rule::in(['ya', 'tidak'])],
            'dshbrd_admin'                  => ['required', Rule::in(['ya', 'tidak'])],
            'verif_token'                   => ['required', Rule::in(['ya', 'tidak'])],
            'anti_csrf'                     => ['required', Rule::in(['ya', 'tidak'])],
            'pnjelajah_dirt'                => ['required', Rule::in(['ya', 'tidak'])],
            'cttan_user_lvl_manej'          => ['nullable', 'string'],
            'cttan_dshbrd_admin'            => ['nullable', 'string'],
            'cttan_verif_token'             => ['nullable', 'string'],
            'cttan_anti_csrf'               => ['nullable', 'string'],
            'cttan_pnjelajah_dirt'          => ['nullable', 'string'],
            'foto_data_validasi'            => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_dashbrd_admin'            => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_anti_csrf'                => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'foto_penjelajahan_direktori'   => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5000'],
            'assessment_id'                 => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $fieldToUpdate = [];

        $fotoFields = [
            'foto_data_validasi', 'foto_dashbrd_admin', 'foto_anti_csrf', 'foto_penjelajahan_direktori'
        ];

        foreach ($fotoFields as $fields) {
            if ($request->hasFile($fields)) {

                $foto = $request->file($fields);
                $fotoName = $foto->hashName();
                Storage::disk('public')->delete('assessment/kontrol_akses/' . $fields . '/' . basename($data->$fields));
                $foto->storeAs('public/assessment/kontrol_akses/' . $fields, $fotoName);
                $fieldToUpdate[$fields] = $fotoName;
            }
        }

        $fieldToUpdate['user_lvl_manej']        = $request->user_lvl_manej;
        $fieldToUpdate['dshbrd_admin']          = $request->dshbrd_admin;
        $fieldToUpdate['verif_token']           = $request->verif_token;
        $fieldToUpdate['anti_csrf']             = $request->anti_csrf;
        $fieldToUpdate['pnjelajah_dirt']        = $request->pnjelajah_dirt;
        $fieldToUpdate['cttan_user_lvl_manej']  = $request->cttan_user_lvl_manej;
        $fieldToUpdate['cttan_dshbrd_admin']    = $request->cttan_dshbrd_admin;
        $fieldToUpdate['cttan_verif_token']     = $request->cttan_verif_token;
        $fieldToUpdate['cttan_anti_csrf']       = $request->cttan_anti_csrf;
        $fieldToUpdate['cttan_pnjelajah_dirt']  = $request->cttan_pnjelajah_dirt;
        $fieldToUpdate['assessment_id']         = $request->assessment_id;

        $data->update($fieldToUpdate);

        if ($data) {
            return response()->json(new DefaultResource(true, 'Success', $data), 200);
        }

        return response()->json(new DefaultResource(false, 'Data Gagal Update', null), 400);
    }


    public function destroy($id)
    {
        $data = Kontrol_akses::findOrFail($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $fotoFields = [
            'foto_data_validasi', 'foto_dashbrd_admin', 'foto_anti_csrf', 'foto_penjelajahan_direktori'
        ];

        foreach ($fotoFields as $fields) {
            Storage::disk('public')->delete('assessment/kontrol_akses/' . $fields . '/' . basename($data->$fields));
        }

        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
