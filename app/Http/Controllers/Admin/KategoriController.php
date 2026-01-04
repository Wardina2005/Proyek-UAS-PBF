<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // ======================
    // LIST + SEARCH + PAGINATION
    // ======================
    public function index(Request $request)
    {
        $search = $request->search;

        $kategoris = Kategori::when($search, function ($query) use ($search) {
                $query->where('nama_kategori', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5); // pagination admin

        return view('admin.kategori.index', compact('kategoris', 'search'));
    }

    // ======================
    // SIMPAN KATEGORI
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan kategori: ' . $kategori->nama_kategori
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    // ======================
    // FORM EDIT
    // ======================
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    // ======================
    // UPDATE
    // ======================
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengedit kategori: ' . $kategori->nama_kategori
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    // ======================
    // HAPUS
    // ======================
    public function destroy(Kategori $kategori)
    {
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus kategori: ' . $kategori->nama_kategori
        ]);

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
