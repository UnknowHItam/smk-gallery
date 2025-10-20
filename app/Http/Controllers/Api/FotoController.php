<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        return response()->json(Foto::with('galery')->get());
    }

    public function store(Request $request)
    {
        $foto = Foto::create($request->all());
        return response()->json($foto, 201);
    }

    public function show($id)
    {
        return response()->json(Foto::with('galery')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);
        $foto->update($request->all());
        return response()->json($foto);
    }

    public function destroy($id)
    {
        Foto::destroy($id);
        return response()->json(['message' => 'Foto deleted']);
    }
}
