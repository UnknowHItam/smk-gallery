<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Kategori;
use App\Models\Galery;
use App\Models\Foto;
use App\Services\ImageOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Posts::with([
            'kategori', 
            'petugas', 
            'galery.foto',
            'galery.likes.user',
            'galery.shares.user',
            'galery.downloads.user'
        ]);

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->status == '1' ? 'published' : 'draft';
            $query->where('status', $status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('kategori_id', $request->category);
        }

        $posts = $query->latest('created_at')->paginate(10);
        
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.posts.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'status' => 'required|in:draft,published',
            'foto_utama' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
            'fotos_galeri' => 'nullable|array',
            'fotos_galeri.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:102400'
        ], [
            'foto_utama.required' => 'Foto utama harus diupload',
            'foto_utama.image' => 'File harus berupa gambar',
            'foto_utama.mimes' => 'Format foto harus: jpeg, png, jpg, gif, atau webp',
            'foto_utama.max' => 'Ukuran foto utama maksimal 100MB',
            'fotos_galeri.*.image' => 'Semua file galeri harus berupa gambar',
            'fotos_galeri.*.mimes' => 'Format foto galeri harus: jpeg, png, jpg, gif, atau webp',
            'fotos_galeri.*.max' => 'Ukuran setiap foto galeri maksimal 100MB',
        ]);

        // Get current authenticated petugas
        $petugas = Auth::user();
        
        $post = Posts::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'kategori_id' => $validated['kategori_id'],
            'petugas_id' => $petugas->id,
            'status' => $validated['status'],
            'created_at' => now()
        ]);

        // Create galery for this post
        $galery = Galery::create([
            'post_id' => $post->id,
            'position' => 1,
            'status' => 1
        ]);

        // Upload foto utama (thumbnail)
        if ($request->hasFile('foto_utama')) {
            $fotoUtama = $request->file('foto_utama');
            $filename = 'utama_' . time() . '.' . $fotoUtama->getClientOriginalExtension();
            $fotoUtama->storeAs('posts', $filename, 'public');

            // Insert dengan created_at yang lebih awal dan judul 'Foto Utama' untuk memastikan selalu di posisi pertama
            Foto::create([
                'galery_id' => $galery->id,
                'file' => $filename,
                'judul' => 'Foto Utama',
                'created_at' => now()->subYears(10)
            ]);
        }

        // Upload foto galeri lainnya (multiple)
        if ($request->hasFile('fotos_galeri')) {
            foreach ($request->file('fotos_galeri') as $index => $foto) {
                $filename = 'galeri_' . time() . '_' . $index . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('posts', $filename, 'public');

                Foto::create([
                    'galery_id' => $galery->id,
                    'file' => $filename,
                    'judul' => $request->input('foto_galeri_judul.' . $index, '')
                ]);
            }
        }

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil ditambahkan');
    }

    public function edit(Posts $post)
    {
        $kategoris = Kategori::all();
        $post->load(['kategori', 'galery.foto']);
        return view('admin.posts.edit', compact('post', 'kategoris'));
    }

    public function update(Request $request, Posts $post)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'status' => 'required|in:draft,published',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
            'fotos_galeri' => 'nullable|array',
            'fotos_galeri.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:102400'
        ], [
            'foto_utama.image' => 'File harus berupa gambar',
            'foto_utama.mimes' => 'Format foto harus: jpeg, png, jpg, gif, atau webp',
            'foto_utama.max' => 'Ukuran foto utama maksimal 100MB',
            'fotos_galeri.*.image' => 'Semua file galeri harus berupa gambar',
            'fotos_galeri.*.mimes' => 'Format foto galeri harus: jpeg, png, jpg, gif, atau webp',
            'fotos_galeri.*.max' => 'Ukuran setiap foto galeri maksimal 100MB',
        ]);

        // Update post data
        $post->update([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'kategori_id' => $validated['kategori_id'],
            'status' => $validated['status'],
            'updated_at' => now()
        ]);

        // Get or create galery
        $galery = $post->galery()->first();
        if (!$galery) {
            $galery = Galery::create([
                'post_id' => $post->id,
                'position' => 1,
                'status' => 1
            ]);
        }

        // Handle foto utama upload
        if ($request->hasFile('foto_utama')) {
            // Delete old foto utama (yang punya judul 'Foto Utama')
            $oldFotoUtama = $galery->foto()
                ->where('judul', 'Foto Utama')
                ->first();
            
            if ($oldFotoUtama) {
                Storage::disk('public')->delete('posts/' . $oldFotoUtama->file);
                $oldFotoUtama->delete();
            }

            // Upload new foto utama
            $fotoUtama = $request->file('foto_utama');
            $filename = 'utama_' . time() . '.' . $fotoUtama->getClientOriginalExtension();
            $fotoUtama->storeAs('posts', $filename, 'public');

            // Insert dengan created_at yang lebih awal untuk memastikan selalu di posisi pertama
            Foto::create([
                'galery_id' => $galery->id,
                'file' => $filename,
                'judul' => 'Foto Utama',
                'created_at' => now()->subYears(10)
            ]);
        }

        // Handle foto galeri uploads (add to existing)
        if ($request->hasFile('fotos_galeri')) {
            foreach ($request->file('fotos_galeri') as $index => $foto) {
                $filename = 'galeri_' . time() . '_' . $index . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('posts', $filename, 'public');
                
                Foto::create([
                    'galery_id' => $galery->id,
                    'file' => $filename,
                    'judul' => $request->input('foto_galeri_judul.' . $index, '')
                ]);
            }
        }

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil diperbarui!');
    }

    public function destroy(Posts $post)
    {
        // Delete associated photos
        foreach ($post->galery as $galery) {
            foreach ($galery->foto as $foto) {
                Storage::disk('public')->delete('posts/' . $foto->file);
            }
        }
        
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil dihapus');
    }

    public function deletePhoto(Foto $foto)
    {
        try {
            // Delete file from storage
            Storage::disk('public')->delete('posts/' . $foto->file);
            
            // Delete from database
            $foto->delete();
            
            // Return JSON response for AJAX
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Foto berhasil dihapus'
                ]);
            }
            
            // Fallback for non-AJAX requests
            return back()->with('success', 'Foto berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus foto: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Gagal menghapus foto: ' . $e->getMessage());
        }
    }

    public function stats(Posts $post)
    {
        $post->load([
            'galery.likes.user',
            'galery.shares.user',
            'galery.downloads.user',
            'galery.foto'
        ]);

        // Collect all interactions
        $likes = collect();
        $shares = collect();
        $downloads = collect();

        foreach ($post->galery as $gallery) {
            $likes = $likes->merge($gallery->likes);
            $shares = $shares->merge($gallery->shares);
            $downloads = $downloads->merge($gallery->downloads);
        }

        return view('admin.posts.stats', compact('post', 'likes', 'shares', 'downloads'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,unpublish,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:posts,id'
        ]);

        $action = $request->action;
        $ids = $request->ids;

        try {
            switch ($action) {
                case 'publish':
                    Posts::whereIn('id', $ids)->update(['status' => 'published']);
                    $message = count($ids) . ' postingan berhasil dipublish';
                    break;

                case 'unpublish':
                    Posts::whereIn('id', $ids)->update(['status' => 'draft']);
                    $message = count($ids) . ' postingan berhasil dijadikan draft';
                    break;

                case 'delete':
                    // Delete related photos and galleries first
                    $posts = Posts::whereIn('id', $ids)->with('galery.foto')->get();
                    
                    foreach ($posts as $post) {
                        foreach ($post->galery as $gallery) {
                            // Delete photos from storage
                            foreach ($gallery->foto as $foto) {
                                Storage::disk('public')->delete('posts/' . $foto->file);
                            }
                            // Delete photo records
                            $gallery->foto()->delete();
                        }
                        // Delete gallery records
                        $post->galery()->delete();
                    }
                    
                    // Delete posts
                    Posts::whereIn('id', $ids)->delete();
                    $message = count($ids) . ' postingan berhasil dihapus';
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
