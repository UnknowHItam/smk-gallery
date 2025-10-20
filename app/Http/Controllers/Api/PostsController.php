<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return response()->json(
            Posts::with(['kategori', 'petugas', 'galery.foto'])->get()
        );
    }

    public function store(Request $request)
    {
        $post = Posts::create($request->all());
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Posts::with(['kategori', 'petugas', 'galery.foto'])->findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        Posts::destroy($id);
        return response()->json(['message' => 'Post deleted']);
    }
}
