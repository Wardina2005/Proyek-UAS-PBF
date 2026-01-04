<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * 📦 LIST PRODUK + SEARCH + PAGINATION
     */
    public function index(Request $request)
    {
        $products = Product::with('kategori')
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama_produk', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(5);

        return view('admin.produk.index', compact('products'));
    }

    /**
     * ➕ FORM TAMBAH PRODUK
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.produk.create', compact('kategoris'));
    }

    /**
     * 💾 SIMPAN PRODUK BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('produk', 'public');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoPath,
        ]);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * ✏️ FORM EDIT PRODUK
     */
    public function edit(Product $produk)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * 🔄 UPDATE PRODUK
     */
    public function update(Request $request, Product $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_produk',
            'kategori_id',
            'harga',
            'stok',
            'deskripsi',
        ]);

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * 🗑️ HAPUS PRODUK
     */
    public function destroy(Product $produk)
    {
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
