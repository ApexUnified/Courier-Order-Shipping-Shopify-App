<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderFetchController extends Controller
{


    public function index()
    {
        return view("Orders.index");
    }


    public function OrderSend(Request $request)
    {
        if ($request->has("order_ids")) {

            $shop = Auth::user();
            $response = $shop->api()->rest("GET", "/admin/api/2025-01/orders.json");
            $response = $response["body"]["container"]["orders"];

            $orders = collect($response);
            dd($orders);
            $ids = $request->input("order_ids");
            $SelectedOrders =  $orders->whereIn("id", $ids);
            if ($SelectedOrders->isNotEmpty()) {

                $result = Http::post("https://riderex.free.beeceptor.com");
                Log::info($result);

                return response()->json(["status" => "true"]);
            } else {
                return response()->json(["status" => "false"]);
            }
        }
    }
}
