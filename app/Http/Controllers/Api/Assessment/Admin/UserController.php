<?php

namespace App\Http\Controllers\Api\Assessment\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $getData = User::all();

        if ($getData->isEmpty()) {
            return response()->json(new UserResource(false, "No Content", null), 204);
        }

        return response()->json(new UserResource(true, "Success", $getData), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required',
            'role'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $getData = User::where([
            'name'      => $request->name,

        ])->get();

        if ($getData->count() > 0)
            return response()->json(new UserResource(false, "Duplikat", $getData), 409);

        //create user
        $data = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'      => $request->role,
        ]);

        if ($data) {
            return response()->json(new UserResource(true, "Success", $data), 200);
        }

        return response()->json(new UserResource(false, "Data gagal diinput", null), 400);
    }

    public function show($id)
    {
        $getData = User::whereId($id)->first();

        if ($getData) {
            return response()->json(new UserResource(true, "Success", $getData), 200);
        }

        return response()->json(new UserResource(false, "Not Found", null), 404);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required',
            'role'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        if ($user) {
            return response()->json(new UserResource(true, "Seccess", $user), 200);
        }

        return response()->json(new UserResource(false, "Data Gagal diupdate", null), 400);
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json(new UserResource(true, "Success", null), 200);
        }

        return response()->json(new UserResource(false, "Data Gagal dihapus", null), 400);
    }
}
