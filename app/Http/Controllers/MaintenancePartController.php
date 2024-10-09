<?php

namespace App\Http\Controllers;

use App\Models\MaintenancePart;
use App\Models\Product;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenancePartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan pengguna sudah autentikasi
        $this->middleware('permission:view-maintenance', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-maintenance', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-maintenance', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-maintenance', ['only' => ['destroy']]);
    }

    public function index()
    {
        $maintenanceParts = MaintenancePart::with(['product', 'part', 'user'])->get();
        return view('maintenance.index', compact('maintenanceParts'));
    }

    public function create()
    {
        $products = Product::all();
        return view('maintenance.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'part.*' => 'required|exists:parts,id',
            'condition.*' => 'required',
        ]);

        foreach ($request->part as $key => $partId) {
            MaintenancePart::create([
                'product_id' => $request->product_id,
                'part_id' => $partId,
                'condition' => $request->condition[$key],
                'user_id' => Auth::id(),
                'checked_at' => now(),
                'note' => $request->note[$key] ?? null
            ]);
        }

        return redirect()->route('maintenance.index')->with('success', 'Maintenance parts created successfully.');
    }

    public function edit($id)
    {
        $maintenancePart = MaintenancePart::findOrFail($id);
        return view('maintenance.edit', compact('maintenancePart'));
    }

    public function update(Request $request, $id)
    {
        $maintenancePart = MaintenancePart::findOrFail($id);

        $request->validate([
            'condition' => 'required',
            'note' => 'nullable',
        ]);

        $maintenancePart->update([
            'condition' => $request->condition,
            'note' => $request->note
        ]);

        return redirect()->route('maintenance.index')->with('success', 'Maintenance part updated successfully.');
    }

    public function destroy($id)
    {
        $maintenancePart = MaintenancePart::findOrFail($id);
        $maintenancePart->delete();

        return redirect()->route('maintenance.index')->with('success', 'Maintenance part deleted successfully.');
    }
}
