<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\repair;
use App\Models\Part;
use App\Models\Product;
use App\Controller\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PartRestockRequest;

class RepairController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan pengguna sudah autentikasi
        $this->middleware('permission:view-repair', ['only' => ['index', 'detail', 'show']]);
        $this->middleware('permission:edit-repair', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-repair', ['only' => ['destroy']]);
        $this->middleware('permission:approve-foreman', ['only' => ['approveForeman']]);
        $this->middleware('permission:delete-section', ['only' => ['approveSection']]);
    }

    public function index()
    {
        // Eager load the related Product and Part models
        $repairs = repair::with(['product', 'part', 'user'])->get();
        $products = Product::all(); // Get all products
    
        return view('repair.index', compact('repairs', 'products'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'shift_problem.*' => 'required|string',
            'penanggulangan.*' => 'required|string',
            'item_penggantian.*' => 'required|exists:parts,id',
            'qty.*' => 'required|integer|min:1',
            'progres.*' => 'nullable|string',
        ]);
    
        $partsToRestock = []; 
        foreach ($request->item_penggantian as $index => $partId) {
            $part = Part::findOrFail($partId);
            $requestedQty = $request->qty[$index];
    
            // Check if requested quantity is less than or equal to stock
            if ($requestedQty > $part->qty) {
                return back()->withErrors([
                    'qty' => 'QTY pengambilan untuk item ' . $part->name . ' harus lebih kecil dari stok (' . $part->qty . ')!',
                ])->withInput();
            }
    
            $newQty = $part->qty - $requestedQty;
            if ($newQty < $part->qty_minimum) {
                $partsToRestock[] = [
                    'name' => $part->name,
                    'qty_order' => $part->qty_order,
                ];
            }
    
            // Update the part's quantity
            $part->update(['qty' => $newQty]);
    
            // Create repair entry for each row
            repair::create([
                'Id_dies' => $request->input('Id_dies'), // Assuming this comes from the form
                'shift_problem' => $request->shift_problem[$index],
                'penanggulangan' => $request->penanggulangan[$index],
                'item_penggantian' => $partId, // Save the part ID
                'qty' => $requestedQty,
                'pic' => auth()->id(),
                'progres' => $request->progres[$index] ?? null,
                'status' => '1', // Default status
            ]);
    
            // Save to request_stock table
            \DB::table('request_stock')->insert([
                'id_part' => $partId,
                'qty_order' => $requestedQty,
                'created_at' => now(),
                'created_by' => auth()->id(), // Assuming you have user authentication
            ]);
        }
    
        // Send email with parts to restock
        try {
            Mail::to("christoperrichard20@gmail.com")->send(new PartRestockRequest('Tim Purchasing PT Mekar Armada Jaya', '', $partsToRestock));
            $emailStatus = 'Email has been sent successfully.';
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            $emailStatus = 'There was an issue sending the email. Please try again.';
        }
    
        return redirect()->route('maintenances.create', ['product' => $request->input('Id_dies')])->with('success', 'Data Penanggulangan Problem successfully saved. ' . $emailStatus);
    }
    public function detail($id)
    {
        // Fetch the problem details using the ID
        $problem = repair::with(['foreman', 'section'])->findOrFail($id);

        // Return a view to display the details
        return view('repair.detail', compact('problem'));
    }

    public function show($id)
    {
        // Fetch the problem details using the ID
        $problem = repair::findOrFail($id);


        // Send email if there are parts to restock
        if (!empty($partsToRestock)) {
            Mail::to('christoperrichard20@gmail.com')->send(new PartRestockRequest($partsToRestock));
        }

        // Return a view to display the details
        return view('repair.detail', compact('problem'));
    }

    public function ubah($id)
    {
        // Fetch the problem details using the ID
        $problem = repair::findOrFail($id);
        // Retrieve all parts for the dropdown
        $parts = Part::all();

        // Return a view to display the details
        return view('repair.edit', compact('problem', 'parts'));
    }

    public function approveForeman(Request $request, $id)
    {
        $problem = repair::findOrFail($id);
        $problem->status = 2; // Approve
        $problem->approved_foreman = auth()->id(); // Assuming 'username' is a column in your users table

        // Save the changes
        $problem->save();

        $message = ($request->action == 'approve') ? 'Problem approved successfully.' : 'Problem rejected successfully.';
        return redirect()->route('repair.index')->with('success', $message);
    }

    public function approveSection(Request $request, $id)
    {
        $problem = repair::findOrFail($id);
        $problem->approved_section = auth()->id(); // Assuming 'username' is a column in your users table
        $problem->status = 3; 
        
        $problem->save();
        $message = ($request->action == 'approve') ? 'Problem approved successfully.' : 'Problem rejected successfully.';
        return redirect()->route('repair.index')->with('success', $message);
    }
    public function edit($id)
    {
        // Fetch the problem details using the ID
        $problem = repair::with(['product', 'part'])->findOrFail($id);
    
        // Retrieve all parts for the dropdown
        $parts = Part::all();
    
        // Return a view to display the edit form
        return view('repair.edit', compact('problem', 'parts'));
    }
    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'shift_problem' => 'required|string',
            'penanggulangan' => 'required|string',
            'item_penggantian' => 'required|exists:parts,id',
            'qty' => 'required|integer|min:1',
            'progres' => 'nullable|string',
        ]);
    
        // Update the problem
        $problem = repair::findOrFail($id);
       
        if($request->item_penggantian != $request->id_before){
            $part = Part::findOrFail($request->id_before);
            $newQty = $part->qty + $request->qty_before;
            $part->update(['qty' => $newQty]);

            //
            $part_new = Part::findOrFail($request->item_penggantian);
            $newQtyPart = $part_new->qty - $request->qty;
            $part_new->update(['qty' => $newQtyPart]);

        }else if($request->item_penggantian == $request->id_before &&$request->qty_before != $request->qty ){
             $part = Part::findOrFail($request->item_penggantian); 
            $newQty = $part->qty + $request->qty_before - $request->qty;
            $part->update(['qty' => $newQty]);
        }
      
    
        // Check if the new stock is below the minimum quantity
        // if ($newQty < $part->qty_minimum) {
        //     // Prepare the data for the email
        //     $partsToRestock = [
        //         [
        //             'name_before' =>  $request->name_before,
        //             'name' => $part->name,
        //             'qty_before' =>  $request->qty_before,
        //             'qty_order' => $part->qty_order,
                    
        //         ]
        //     ];
    
        //     // Send email with parts to restock
        //     try {
        //         Mail::to("christoperrichard20@gmail.com")->send(new PartRestockRequest('Tim Purchasing PT Mekar Armada Jaya', '', $partsToRestock));
        //         $emailStatus = 'Email has been sent successfully.';
        //     } catch (\Exception $e) {
        //         \Log::error('Email sending failed: ' . $e->getMessage());
        //         $emailStatus = 'There was an issue sending the email. Please try again.';
        //     }
        // }
    
        // Update the repair entry
        $problem->update([
            'shift_problem' => $request->shift_problem,
            'penanggulangan' => $request->penanggulangan,
            'item_penggantian' => $request->item_penggantian, 
            'qty' => $request->qty,
            'pic' => auth()->id(),
            'progres' => $request->progres ?? 'N/A',
            'status' => 1, 
        ]);
    
        return redirect()->route('repair.index')->with('success', 'Data Penanggulangan Problem successfully updated. ' . ($emailStatus ?? ''));
    }

    public function problem(Request $request)
    {
        // Fetch parts from the database to be used in the dropdown
        $parts = Part::select('id', 'name', 'qty')->get();
    
        // Get Id_dies from the URL
        $id_dies = $request->query('id_dies');
    
        // Pass the parts data and id_dies to the view
         return view('repair.create', compact('parts', 'id_dies'));
    }
}
