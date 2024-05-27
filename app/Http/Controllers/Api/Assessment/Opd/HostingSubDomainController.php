<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Hosting_sub_domain;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class HostingSubDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Hosting_sub_domain::with('assessment')->when(request()->q, function ($query) {
            $query->where('nama_subdomain', 'like', '%' . request()->q . '%');
        })->get();

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
            'collocation_server'    => ['required', Rule::in(['ya', 'tidak'])],
            'hosting'               => ['required', Rule::in(['ya', 'tidak'])],
            'sub_domain'            => ['required', Rule::in(['ya', 'tidak'])],
            'nama_subdomain'        => ['required', 'string', 'max:50'],
            'cttan_collock_server'  => ['nullable', 'string'],
            'cttan_hosting'         => ['nullable', 'string'],
            'cttan_sub_domain'      => ['nullable', 'string'],
            'assessment_id'         => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $getData = Hosting_sub_domain::where([
            'nama_subdomain' => $request->nama_subdomain,
            'assessment_id'  => $request->assessment_id,
        ])->get();

        if ($getData->count() > 0) {
            return response()->json(new DefaultResource(false, 'Duplicate', $getData), 409);
        }

        $data = Hosting_sub_domain::create([
            'collocation_server' => $request->collocation_server,
            'hosting' => $request->hosting,
            'sub_domain' => $request->sub_domain,
            'nama_subdomain' => $request->nama_subdomain,
            'cttan_collock_server' => $request->cttan_collock_server,
            'cttan_hosting' => $request->cttan_hosting,
            'cttan_sub_domain' => $request->cttan_sub_domain,
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
        $getData = Hosting_sub_domain::with('assessment')->when(request()->q, function ($query) {
            $query->where('nama_subdomain', 'like', '%' . request()->q . '%');
        })->whereId($id)->first();

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
            'collocation_server'    => ['required', Rule::in(['ya', 'tidak'])],
            'hosting'               => ['required', Rule::in(['ya', 'tidak'])],
            'sub_domain'            => ['required', Rule::in(['ya', 'tidak'])],
            'nama_subdomain'        => ['required', 'string', 'max:50'],
            'cttan_collock_server'  => ['nullable', 'string'],
            'cttan_hosting'         => ['nullable', 'string'],
            'cttan_sub_domain'      => ['nullable', 'string'],
            'assessment_id'         => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Hosting_sub_domain::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $data->update([
            'collocation_server' => $request->collocation_server,
            'hosting' => $request->hosting,
            'sub_domain' => $request->sub_domain,
            'nama_subdomain' => $request->nama_subdomain,
            'cttan_collock_server' => $request->cttan_collock_server,
            'cttan_hosting' => $request->cttan_hosting,
            'cttan_sub_domain' => $request->cttan_sub_domain,
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
        $data = Hosting_sub_domain::find($id);

        if (!$data) {
            return response()->json(new DefaultResource(false, 'Not Found', null), 404);
        }

        $data->delete();

        return response()->json(new DefaultResource(true, 'Success', null), 200);
    }
}
