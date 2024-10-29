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

    public function index()
    {
        // Only get parts with status 1 (active) and load the associated product
        $parts = Part::with('product')
                    ->where('status', 1)
                    ->get();

        // Pass 'parts' data to the view
        return view('parts.index', compact('parts'));
    }

    public function create()
    {
        return view('parts.create');
    }

    // Menyimpan bagian baru ke database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|array', // Update to allow nested array
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1',
            
        ]);

        $userId = auth()->user()->id;

        // Loop through each part and save it to the database
        for ($i = 0; $i < count($request->name); $i++) {
            $part = new Part();
            $part->name = $request->name[$i];
            $part->qty = $request->qty[$i];
            $part->status = 1; 
            $part->created_by = $userId; 
            $part->updated_by = $userId; 
            $part->qty_order = $request->qty_order[$i];
            $part->qty_minimum = $request->qty_minimum[$i];
            // Handle multiple descriptions
            $part->description = implode(',', $request->description[$i]); // Concatenate descriptions into a single string
            $part->save();
        }

        return redirect()->route('parts.index')->with('success', 'Parts added successfully.');
    }

    

    // Menampilkan form untuk mengedit bagian yang ada
    public function edit( $partId)
    {
        $part = Part::findOrFail($partId);
        return view('parts.edit', compact('part'));
    }

    // Memperbarui bagian yang ada di database
    public function update(Request $request, $partId)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'qty' => 'required|integer|min:1',
        ]);

        // Find the part by its ID and update
        $part = Part::findOrFail($partId);
        $part->name = $request->name;
        $part->description = $request->description;
        $part->qty = $request->qty;
        $part->qty_minimum = $request->qty_minimum;
        $part->qty_order = $request->qty_order;
        $part->updated_by = auth()->user()->id; // Update the updated_by field with the logged-in user
        $part->save();

        return redirect()->route('parts.index')
                        ->with('success', 'Part updated successfully.');
    }



    // Menghapus bagian dari database
    public function destroy($partId)
    {
        // Find the part by its ID
        $part = Part::findOrFail($partId);
        
        // Set the status to 0 (inactive) instead of deleting
        $part->status = 0;
        $part->updated_by = auth()->user()->id; // Track who marked it as deleted
        $part->save();

        // Redirect with success message
        return redirect()->route('parts.index')
                        ->with('success', 'Part marked as deleted successfully.');
    }

    public function getPartsByProduct($productId)
    {
        $parts = Part::where('product_id', $productId)->get();
        return response()->json($parts);
    }

}
