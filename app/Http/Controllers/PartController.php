<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan pengguna sudah autentikasi
        $this->middleware('permission:view-part', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-part', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-part', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-part', ['only' => ['destroy']]);
    }

    // Menampilkan daftar semua produk dan bagian mereka
    public function index()
    {
        $products = Product::with('parts')->get(); // Ambil semua produk beserta bagian-bagiannya
        return view('parts.index', compact('products'));
    }

    // Menampilkan form untuk membuat bagian baru
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('parts.create', compact('product'));
    }

    // Menyimpan bagian baru ke database
    public function store(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $part = new Part();
        $part->name = $request->name;
        $part->description = $request->description;
        $part->product_id = $productId;
        $part->save();

        return redirect()->route('products.parts.index', $productId)
                         ->with('success', 'Part added successfully.');
    }

    // Menampilkan form untuk mengedit bagian yang ada
    public function edit($productId, $partId)
    {
        $part = Part::findOrFail($partId);
        $product = Product::findOrFail($productId);
        return view('parts.edit', compact('part', 'product'));
    }

    // Memperbarui bagian yang ada di database
    public function update(Request $request, $productId, $partId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $part = Part::findOrFail($partId);
        $part->name = $request->name;
        $part->description = $request->description;
        $part->save();

        return redirect()->route('products.parts.index', $productId)
                         ->with('success', 'Part updated successfully.');
    }

    // Menghapus bagian dari database
    public function destroy($productId, $partId)
    {
        $part = Part::findOrFail($partId);
        $part->delete();

        return redirect()->route('products.parts.index', $productId)
                         ->with('success', 'Part deleted successfully.');
    }
}
