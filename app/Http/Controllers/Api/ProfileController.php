<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json(Profile::all());
    }

    public function store(Request $request)
    {
        $profile = Profile::create($request->all());
        return response()->json($profile, 201);
    }

    public function show($id)
    {
        return response()->json(Profile::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());
        return response()->json($profile);
    }

    public function destroy($id)
    {
        Profile::destroy($id);
        return response()->json(['message' => 'Profile deleted']);
    }
}
