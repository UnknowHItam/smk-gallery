<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        return response()->json(Galery::with('foto')->get());
    }

    public function store(Request $request)
    {
        $galery = Galery::create($request->all());
        return response()->json($galery, 201);
    }

    public function show($id)
    {
        return response()->json(Galery::with('foto')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $galery = Galery::findOrFail($id);
        $galery->update($request->all());
        return response()->json($galery);
    }

    public function destroy($id)
    {
        Galery::destroy($id);
        return response()->json(['message' => 'Galery deleted']);
    }
}
