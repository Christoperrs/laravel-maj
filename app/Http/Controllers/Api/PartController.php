<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartController extends Controller
{
    // Mendapatkan semua part
    public function index()
    {
        $parts = Part::all();
        return response()->json($parts, 200);
    }

    // Menyimpan part baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|array', // Pastikan deskripsi bisa berupa array
            'qty' => 'required|integer',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $part = Part::create([
            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'status' => $request->status,
            'created_by' => auth()->id(), // Menyimpan ID pengguna yang membuat
        ]);

        return response()->json($part, 201);
    }

    // Mendapatkan part berdasarkan ID
    public function show($id)
    {
        $part = Part::find($id);
        if (!$part) {
            return response()->json(['message' => 'Part not found'], 404);
        }
        return response()->json($part, 200);
    }

    // Memperbarui part berdasarkan ID
    public function update(Request $request, $id)
    {
        $part = Part::find($id);
        if (!$part) {
            return response()->json(['message' => 'Part not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'qty' => 'nullable|integer',
            'status' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $part->update($request->only(['name', 'description', 'qty', 'status']));
        return response()->json($part, 200);
    }

    // Menghapus part berdasarkan ID
    public function destroy($id)
    {
        $part = Part::find($id);
        if (!$part) {
            return response()->json(['message' => 'Part not found'], 404);
        }

        $part->delete();
        return response()->json(['message' => 'Part deleted successfully'], 200);
    }
    public function getPartsByProduct($productId)
    {
        $parts = Part::where('product_id', $productId)->get();
        return response()->json($parts);
    }
}
