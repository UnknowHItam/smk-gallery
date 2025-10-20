<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        return response()->json(Petugas::all());
    }

    public function store(Request $request)
    {
        $petugas = Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ]);
        return response()->json($petugas, 201);
    }

    public function show($id)
    {
        return response()->json(Petugas::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        return response()->json($petugas);
    }

    public function destroy($id)
    {
        Petugas::destroy($id);
        return response()->json(['message' => 'Petugas deleted']);
    }
}
