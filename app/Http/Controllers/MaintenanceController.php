<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\MaintenanceDetail;
use App\Models\Product;
use App\Models\Part;
use App\Models\DetailPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('parts')->get();
        
        $selectedProduct = null;
        $maintenances = collect();
        $parts = collect();

        if ($request->has('product')) {
            $selectedProduct = Product::with('parts')->find($request->product);

            if (!$selectedProduct) {
                return redirect()->back()->withErrors('Product not found.');
            }

            $maintenances = Maintenance::with(['maintenanceDetails.part', 'user'])
                ->where('product_id', $selectedProduct->id)
                ->get();

            $parts = $selectedProduct->parts;
        }

        return view('maintenances.index', compact('products', 'maintenances', 'selectedProduct', 'parts'));
    }
    

    public function create(Request $request)
    {
        $productId = $request->query('product');
        
        // Ambil produk berdasarkan ID
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->withErrors('Product not found.');
        }
        
        // Ambil part yang terkait dengan produk menggunakan detail_part
        $parts = DetailPart::with('part')->where('product_id', $productId)->get();

        // Debugging untuk memastikan data parts ada
        if ($parts->isEmpty()) {
            return view('maintenances.create', ['product' => $product])->withErrors('Part not found.');
        }

        return view('maintenances.create', compact('parts', 'product'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'note' => 'nullable|string',
            'conditions' => 'required|array',
            'product_id' => 'required|exists:products,id', // Validasi product_id
        ]);
    
        $productId = $request->product_id; // Ambil product_id dari request
        $userId = auth()->id(); // Ambil ID user yang sedang login
    
        if (!$userId) {
            return redirect()->back()->withErrors('User not logged in.');
        }
    
        // Loop melalui kondisi yang dikirimkan
        foreach ($request->conditions as $partId => $conditions) {
            // Ambil deskripsi dari tabel parts, pastikan menggunakan 'id' yang valid
            $descriptionId = Part::where('id', $partId)->value('id');
    
            if (!$descriptionId) {
                return redirect()->back()->withErrors("Description not found for part with id $partId.");
            }
    
            // Simpan ke tabel maintenance
            $maintenance = Maintenance::create([
                'product_id' => $productId,
                'part_id' => $partId,
                'note' => $request->note,
                'user_id' => $userId,
                'created_at' => now(),
            ]);
    
            // Simpan detail maintenance ke tabel maintenance_details
            foreach ($conditions as $condition) {
                MaintenanceDetail::create([
                    'maintenance_id' => $maintenance->id,
                    'part_id' => $partId,
                    'description_id' => $descriptionId, // Pastikan 'description_id' terisi dengan benar
                    'condition' => $condition,
                ]);
            }
        }
    
        return redirect()->route('maintenances.index')->with('success', 'Maintenance created successfully!');
    }
    




    public function show(Maintenance $maintenance)
    {
        // Load relasi yang diperlukan
        $maintenance->load('product', 'maintenanceDetails.part', 'user');
        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        // Load relasi yang diperlukan
        $maintenance->load('product', 'maintenanceDetails.part');
        $products = Product::with('parts')->get();
        return view('maintenances.edit', compact('maintenance', 'products'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'note' => 'nullable|string|max:255',
            'conditions' => 'required|array',
        ]);

        // Update maintenance
        $maintenance->update([
            'product_id' => $request->product_id,
            'note' => $request->note,
        ]);

        $product = Product::findOrFail($request->product_id);
        $parts = $product->parts;

        // Update detail maintenance
        foreach ($parts as $part) {
            $descriptions = $part->descriptions; // Pastikan relasi ini benar

            foreach ($descriptions as $description) {
                $condition = $request->input('conditions.' . $part->id . '.' . $description->id);
                
                $maintenanceDetail = MaintenanceDetail::where('maintenance_id', $maintenance->id)
                    ->where('part_id', $part->id)
                    ->where('description_id', $description->id)
                    ->first();

                if ($maintenanceDetail) {
                    $maintenanceDetail->update(['condition' => $condition]);
                } else {
                    MaintenanceDetail::create([
                        'maintenance_id' => $maintenance->id,
                        'part_id' => $part->id,
                        'description_id' => $description->id,
                        'condition' => $condition,
                    ]);
                }
            }
        }

        return redirect()->route('maintenances.index')->with('success', 'Maintenance updated successfully.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Maintenance deleted successfully.');
    }

    public function getPartDescriptions($productId)
    {
        // Ambil part yang terkait dengan produk
        $parts = Part::where('product_id', $productId)->get();

        // Format data untuk dikirim ke frontend
        $data = [];
        foreach ($parts as $part) {
            $data[$part->id] = [
                'part_name' => $part->name,
                'description' => $part->description, // Ambil deskripsi dari field parts
            ];
        }

        return response()->json($data);
    }
    public function approve(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        // Validasi input
        $request->validate([
            'approval' => 'required|in:approved,no approve',
        ]);

        // Update status approval
        $maintenance->approval_status = $request->approval; // Ubah sesuai dengan tipe data
        $maintenance->approved_by = auth()->user()->id; // Simpan ID pengguna yang mengapprove

        $maintenance->save();

        return redirect()->route('maintenances.index')->with('success', 'Maintenance status updated successfully.');
    }

    public function board()
    {
        // Ambil semua data maintenance
        $maintenances = Maintenance::with(['product', 'maintenanceDetails.part', 'user'])
            ->orderBy('created_at', 'desc')->get();

        return view('maintenances.board', compact('maintenances'));
    }
    
}
