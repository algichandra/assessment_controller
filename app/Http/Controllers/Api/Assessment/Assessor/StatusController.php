<?php

namespace App\Http\Controllers\Api\Assessment\Assessor;

use App\Models\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $getData = Status::all();

        if ($getData->isEmpty()) {
            return response()->json(new DefaultResource(false, 'No Content', null), 204);
        }

        return response()->json(new DefaultResource(true, 'Success', $getData), 200);
    }
}
