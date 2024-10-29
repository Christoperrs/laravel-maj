<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StrokeLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PreventiveController extends Controller
{
    public function index()
    {
        $apiResponse = Http::get('http://192.168.10.67/majsf_rest_api/api/inventory_achievement/stroke_running_text');
        $apiData = $apiResponse->json();
        $today = Carbon::today()->toDateString();

        $productsWithProcesses = [];

        foreach ($apiData as $apiProduct) {
            Log::info('API Product:', $apiProduct);

            $product = Product::where('part_no', $apiProduct['part_rh'])->first();

            if ($product) {
                $existingLog = StrokeLog::where('part_no', $apiProduct['part_rh'])
                    ->where('machine', $apiProduct['machine'])
                    ->where('process', $apiProduct['process'])
                    ->whereDate('log_date', $today)
                    ->first();

                // Update or create the stroke log
                if ($existingLog) {
                    $existingLog->update([
                        'current_stroke' => $apiProduct['qty_actual_machine'],
                        'accumulative_stroke' => $existingLog->accumulative_stroke + $apiProduct['qty_actual_machine'],
                        'status' => $apiProduct['status'] // Update status
                    ]);
                } else {
                    StrokeLog::create([
                        'part_no' => $apiProduct['part_rh'],
                        'machine' => $apiProduct['machine'],
                        'process' => $apiProduct['process'],
                        'current_stroke' => $apiProduct['qty_actual_machine'],
                        'accumulative_stroke' => $product->accumulative_stroke + $apiProduct['qty_actual_machine'],
                        'log_date' => $today,
                        'status' => $apiProduct['status'], // Simpan status dari API
                    ]);
                }

                $productsWithProcesses[] = [
                    'product_name' => $product->name,
                    'part_no' => $product->part_no,
                    'process' => $apiProduct['process'],
                    'machine' => $apiProduct['machine'],
                    'interval' => $product->frequency_production,
                    'current_stroke' => $apiProduct['qty_actual_machine'],
                    'limit_stroke' => ($product->tension == 'UHT' ? 10000 : 20000),
                    'accumulative_stroke' => $product->accumulative_stroke + $apiProduct['qty_actual_machine'],
                    '%stroke' => ($apiProduct['qty_actual_machine'] / ($product->tension == 'UHT' ? 10000 : 20000)) * 100,
                    'status' => $apiProduct['status'], // status dari API
                ];
            }
        }

        usort($productsWithProcesses, function ($a, $b) {
            return $b['%stroke'] <=> $a['%stroke'];
        });

        return view('preventive.index', compact('productsWithProcesses'));
    }

    public function getCurrentStrokeData()
    {
        $apiResponse = Http::get('http://192.168.10.67/majsf_rest_api/api/inventory_achievement/stroke_running_text');
        $apiData = $apiResponse->json();
        $today = Carbon::today()->toDateString();

        $productsWithProcesses = [];

        foreach ($apiData as $apiProduct) {
            Log::info('API Product:', $apiProduct);

            $product = Product::where('part_no', $apiProduct['part_rh'])->first();

            if ($product) {
                $currentStroke = $apiProduct['qty_actual_machine'];
                $limitStroke = ($product->tension == 'UHT' ? 10000 : 20000);

                $productsWithProcesses[] = [
                    'product_name' => $product->name,
                    'part_no' => $product->part_no,
                    'process' => $apiProduct['process'],
                    'machine' => $apiProduct['machine'],
                    'interval' => $product->frequency_production,
                    'current_stroke' => $currentStroke,
                    'limit_stroke' => $limitStroke,
                    'accumulative_stroke' => $product->accumulative_stroke + $currentStroke,
                    '%stroke' => ($currentStroke / $limitStroke) * 100,
                    'status' => $apiProduct['status'], // status dari API
                ];
            }
        }

        usort($productsWithProcesses, function ($a, $b) {
            return $b['%stroke'] <=> $a['%stroke'];
        });

        return response()->json($productsWithProcesses);
    }

    public function dark()
    {
        $apiResponse = Http::get('http://192.168.10.67/majsf_rest_api/api/inventory_achievement/stroke_running_text');
        $apiData = $apiResponse->json();
        $productsWithProcesses = [];

        foreach ($apiData as $apiProduct) {
            Log::info('API Product:', $apiProduct);

            $product = Product::where('part_no', $apiProduct['part_rh'])->first();

            if ($product) {
                $productsWithProcesses[] = [
                    'product_name' => $product->name,
                    'part_no' => $product->part_no,
                    'process' => $apiProduct['process'],
                    'machine' => $apiProduct['machine'],
                    'interval' => $product->frequency_production,
                    'current_stroke' => $apiProduct['qty_actual_machine'],
                    'limit_stroke' => ($product->tension == 'UHT' ? 10000 : 20000),
                    'accumulative_stroke' => $product->accumulative_stroke,
                    '%stroke' => ($apiProduct['qty_actual_machine'] / ($product->tension == 'UHT' ? 10000 : 20000)) * 100,
                    'status' => $apiProduct['status'],
                ];
            }
        }

        return view('preventive.dark', compact('productsWithProcesses'));
    }
}
