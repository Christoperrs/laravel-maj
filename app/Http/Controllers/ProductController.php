<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Part;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:view-product|create-product|edit-product|delete-product', ['only' => ['index','show']]);
       $this->middleware('permission:create-product', ['only' => ['create','store']]);
       $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(3)
        ]);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {
            // Simpan gambar dan dapatkan path-nya
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = null;
        }

        // Simpan data produk termasuk path gambar
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath, // Simpan path gambar
        ]);

        return redirect()->route('products.index')
                ->withSuccess('New product is added successfully.');
    }

    public function show(Product $product): View
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    public function edit(Product $product): View
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->all();

        // Handle image upload saat update
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image'] = $imagePath;
        }

        // Update data produk
        $product->update($data);

        return redirect()->back()
                ->withSuccess('Product is updated successfully.');
                
    }

    public function destroy(Product $product): RedirectResponse
    {
        // Hapus gambar yang terkait jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus produk
        $product->delete();

        return redirect()->route('products.index')
                ->withSuccess('Product is deleted successfully.');
    }
    public function getParts($id)
    {
        $parts = Part::where('product_id', $id)->get();
        return response()->json($parts);
    }
}
