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
            $ids = $request->input("order_ids");

            $SelectedOrders =  $orders->whereIn("id", $ids)->map(function ($order) {
                return [
                    "id" => $order["id"],
                    "name" => $order['customer']['first_name'] . $order['customer']['last_name']  ?? null,
                    "contact_email" => $order["contact_email"] ?? null,
                    "phone" => $order["phone"] ?? null,
                    "city" => $order["shipping_address"]["city"] ?? null,
                    "zip" => $order["shipping_address"]["zip"] ?? null,
                    "country_code" => $order["shipping_address"]["country_code"] ?? null,
                    "province" => $order["shipping_address"]["province"] ?? null,
                    "country" => $order["shipping_address"]["country"] ?? null,
                    "address2" => $order["shipping_address"]["address1"] ?? $order['shipping_address']['address2'] ?? null,
                    "currency" => $order["currency"] ?? null,
                    "subtotal" => $order["current_subtotal_price"] ?? null,

                ];
            });


            if ($SelectedOrders->isNotEmpty()) {

                $result = Http::post("http://localhost:8000/receive-orders", [
                    "orders" => $SelectedOrders
                ]);

                return response()->json(["status" => "true"]);
            } else {
                return response()->json(["status" => "false"]);
            }
        }
    }
}
