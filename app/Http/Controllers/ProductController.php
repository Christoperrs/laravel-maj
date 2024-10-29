<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Part;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Repair; // Make sure to import the model
use App\Models\Maintenance; // Make sure to import the model
use App\Models\DetailPictureProduct;
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
        $parts = Part::where('status', 1)->get(); // Ambil part dengan status 1 (aktif)
        return view('products.create', compact('parts'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
       
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $allowedExtensions = ['png', 'jpg', 'jpeg'];
    
            // Check if the uploaded file has a valid extension
            if (!in_array($image->getClientOriginalExtension(), $allowedExtensions)) {
                return redirect()->back()
                    ->withErrors(['image' => 'The image must be a file of type: ' . implode(', ', $allowedExtensions) . '.'])
                    ->withInput();
            }
    
            $imagePath = $image->store('product_images', 'public');
      
        } else {
            $imagePath = null;
        }

        // Store product data
        $product = Product::create([
            'name' => $request->name,
            'line' => $request->line,
            'no_job' => $request->no_job,
            'part_no' => $request->part_no,
            'model' => $request->model,
            'process' => $request->process,
            'machine' => $request->machine,
            'frequency_production' => $request->frequency_production,
            'tension' => $request->tension,
            'customer' => $request->customer,
            'status' => 1,
            'image' => $imagePath,
            'created_by'   => auth()->id(),
            'updated_by'   => auth()->id(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Generate and save the QR code for the product
        $productUrl = route('products.show', $product->id);
        $qrCode = QrCode::format('svg')
                        ->size(300)
                        ->generate($productUrl);

        $encryptedFileName = Str::random(40) . '.svg';
        $qrCodePath = 'product_qrcodes/' . $encryptedFileName;
        Storage::disk('public')->put($qrCodePath, $qrCode);

        $product->update([
            'barcode' => $qrCodePath,
        ]);

        // Insert parts into the detail_part table
        if ($request->has('part_check')) {
            
            foreach ($request->part_check as $index => $part_id) {
                if ($part_id) {
                    DB::table('detail_part')->insert([
                        'product_id'   => $product->id,
                        'part_id'      => $part_id,
                        'qty'          => $request->qty[$index],
                     
                        'status'       => 'active',
                        'created_by'   => auth()->id(),
                        'updated_by'   => auth()->id(),
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
                }
            }
        }
        if ($request->hasFile('detail_images')) {
            $allowedExtensions = ['png', 'jpg', 'jpeg']; // Define allowed extensions
        
            foreach ($request->file('detail_images') as $image) {
                // Check if the uploaded file has a valid extension
                if ($image->isValid() && in_array($image->getClientOriginalExtension(), $allowedExtensions)) {
                    $detailImagePath = $image->store('detail_images', 'public');
                    DetailPictureProduct::create([
                        'path_gambar' => $detailImagePath,
                        'id_product' => $product->id,
                        'created_by'   => auth()->id(),
                        'updated_by'   => auth()->id(),
                        'created_at'   => now(),
                        'updated_at'   => now()
                    ]);
                } else {
                    // Handle invalid image format
                    return redirect()->back()
                        ->withErrors(['detail_images' => 'Each detail image must be a file of type: ' . implode(', ', $allowedExtensions) . '.'])
                        ->withInput();
                }
            }
        }
        return redirect()->route('products.index')
                        ->withSuccess('New product is added successfully along with its parts.');
    }

    public function show($id)
    {
      
        $product = Product::with(['parts' => function ($query) {
            $query->where('detail_part.status', 'active');
        }, 'detailPictures'])->findOrFail($id); // Assuming you have a relationship defined
    
        // Fetch related penanggulangan problems
        $problems = Repair::where('Id_dies', $product->id)->get();
    
        // Fetch related maintenances
        $maintenances = Maintenance::where('product_id', $product->id)->get();
    
        
        // Send data to the view
        return view('products.barcode', compact('product', 'problems', 'maintenances'));
    }


    public function edit(Product $product): View
    {
        // Eager load parts with the pivot data and detail pictures
        $product->load(['parts', 'detailPictures']);
        
        return view('products.edit', [
            'product' => $product,
            'parts' => Part::where('status', 1)->get() // Get only active parts
        ]);
    }
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
    
        $data = $request->all();
    
        // Handle image upload saat update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $allowedExtensions = ['png', 'jpg', 'jpeg'];
    
            // Check if the uploaded file has a valid extension
            if (!in_array($image->getClientOriginalExtension(), $allowedExtensions)) {
                return redirect()->back()
                    ->withErrors(['image' => 'The image must be a file of type: ' . implode(', ', $allowedExtensions) . '.'])
                    ->withInput();
            }
    
            $imagePath = $image->store('product_images', 'public');
            $data['image'] = $imagePath;
        }
    
        // Update product data
        $product->update($data);
    
        // Update parts in the detail_part table
        if ($request->has('part_check')) {
            // First, detach all existing parts
            $product->parts()->detach();
    
            // Then, reattach the selected parts
            foreach ($request->part_check as $index => $part_id) {
                if ($part_id) {
                    DB::table('detail_part')->insert([
                        'product_id'   => $product->id,
                        'part_id'      => $part_id,
                        'qty'          => $request->qty[$index],
                        'status'       => 'active',
                        'created_by'   => auth()->id(),
                        'updated_by'   => auth()->id(),
                        'created_at'   => now(),
                        'updated_at'   => now()
                    ]);
                }
            }
        }
    
        // Handle detail images
        if ($request->hasFile('detail_images')) {
            $allowedExtensions = ['png', 'jpg', 'jpeg']; // Define allowed extensions
        
            foreach ($request->file('detail_images') as $image) {
                // Check if the uploaded file has a valid extension
                if ($image->isValid() && in_array($image->getClientOriginalExtension(), $allowedExtensions)) {
                    $detailImagePath = $image->store('detail_images', 'public');
                    DetailPictureProduct::create([
                        'path_gambar' => $detailImagePath,
                        'id_product' => $product->id,
                        'created_by'   => auth()->id(),
                        'updated_by'   => auth()->id(),
                        'created_at'   => now(),
                        'updated_at'   => now()
                    ]);
                } else {
                    // Handle invalid image format
                    return redirect()->back()
                        ->withErrors(['detail_images' => 'Each detail image must be a file of type: ' . implode(', ', $allowedExtensions) . '.'])
                        ->withInput();
                }
            }
        }
    
        return redirect()->route('products.index')
            ->withSuccess('Product is updated successfully.');
    }
    public function deleteDetailPicture($id)
{
    $detailPicture = DetailPictureProduct::findOrFail($id);
    
    // Delete the image file from storage
    if ($detailPicture->path_gambar) {
        Storage::disk('public')->delete($detailPicture->path_gambar);
    }

    // Delete the record from the database
    $detailPicture->delete();

    return response()->json(['success' => 'Image deleted successfully.']);
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

    public function getParts(Product $product)
    {
        // Mengambil part yang terkait dengan produk
        $parts = $product->parts()->get();

        return response()->json(['parts' => $parts]);
    }

    
    
}
