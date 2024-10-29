<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Part; 

class ProductController extends Controller
{
    public function getParts($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product->parts);
    }

    // PartController.php (API)

    public function getDescriptions($id)
    {
        $part = Part::findOrFail($id);
        return response()->json(['descriptions' => $part->description]);
    }
}
