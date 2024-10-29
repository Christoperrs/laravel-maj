<?php

namespace App\Http\Controllers;
use App\Models\RequestStock;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PartRestockRequest;
use App\Mail\PartRestockCancel;

class RequestStockController extends Controller
{
    public function index()
    {
        // Fetch all request stock records
        $requestStocks = RequestStock::with(['part', 'user'])->get(); // This can remain as is

        return view('request.index', compact('requestStocks'));
    }
    public function create()
    {
        $parts = Part::all(); // Get all parts
        return view('request.create', compact('parts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_part.*' => 'required|exists:parts,id',
            'qty_order.*' => 'required|integer|min:1',
        ]);

        $partsToRestock = []; // Prepare an array to hold parts that need restocking

        foreach ($data['id_part'] as $index => $id_part) {
            RequestStock::create([
                'id_part' => $id_part,
                'qty_order' => $data['qty_order'][$index],
                'created_by' => Auth::id(),
                'status' =>1
            ]);

            // Get the part to check its quantity
            $part = Part::findOrFail($id_part);

                $partsToRestock[] = [
                    'name' => $part->name,
                    'qty_order' => $data['qty_order'][$index],
                ];
        

        }

        // Send email with parts to restock
        try {
            Mail::to("christoperrichard20@gmail.com")->send(new PartRestockRequest('Tim Purchasing PT Mekar Armada Jaya', '', $partsToRestock));
            $emailStatus = 'Email has been sent successfully.';
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            $emailStatus = 'There was an issue sending the email. Please try again.';
        }

        return redirect()->route('request.index')->with('success', 'Request stock created successfully. ' . $emailStatus);
    }
    public function update(Request $request)
    {
        // Validate that at least one ID is provided
        $request->validate([
            'request_ids' => 'required|array|min:1',
            'request_ids.*' => 'exists:request_stock,id', // Ensure each ID exists
        ]);
    
        // Get the IDs of the canceled orders
        $canceledOrders = RequestStock::whereIn('id', $request->request_ids)->get();
    
        // Check if there are any canceled orders
        if ($canceledOrders->isEmpty()) {
            return redirect()->route('request.index')->with('error', 'No orders were found for cancellation.');
        }
    
        // Update the status to 0 (canceled) for each selected request stock
        RequestStock::whereIn('id', $request->request_ids)->update(['status' => 0]);
    
        // Prepare data for the email
        $canceledOrderDetails = $canceledOrders->map(function ($order) {
            return [
                'name' => $order->part->name, // Ensure this relationship is correctly defined
                'qty_order' => $order->qty_order,
            ];
        });
        // print_r($canceledOrderDetails);
        // Send email with cancellation details
        try {
            Mail::to("christoperrichard20@gmail.com")->send(new PartRestockCancel('Tim Purchasing PT Mekar Armada Jaya', 'Pembatalan Order', $canceledOrderDetails));
            $emailStatus = 'Email has been sent successfully.';
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            $emailStatus = 'There was an issue sending the email. Please try again.';
        }
    
         return redirect()->route('request.index')->with('success', 'Selected orders have been canceled successfully. ' . $emailStatus);
    }
    
}