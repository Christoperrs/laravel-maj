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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:view-product|create-product|edit-product|delete-product', ['only' => ['index','show']]);
    //     $this->middleware('permission:create-product', ['only' => ['create','store']]);
    //     $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
    //     $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    // }

    public function index(): View
    {
        return view('dash.index');
       
    }

    public function fetchModel(Request $request): JsonResponse
    {
        $company = $request->get('company');
    
        // Fetch products related to the selected company
        $products = Product::where('customer', $company)->get(['model']);
    
        return response()->json(['products' => $products]);
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
    
    // ProductController.php
public function showDies($model)
{
    $product = Product::where('model', $model)->get();


     return view('dash.dies', compact('product'));
}

}
