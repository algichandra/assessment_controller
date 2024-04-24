<?php

namespace App\Http\Controllers\Api\Assessment\Opd;

use App\Models\Jenis_kegiatan;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;

class JenisKegiatanController extends Controller
{
    public function index()
    {
        $getData = Jenis_kegiatan::all();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, 'No Content', null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }
}
