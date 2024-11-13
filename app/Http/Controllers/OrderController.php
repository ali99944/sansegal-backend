<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('items', 'client')->get();
        return response()->json($orders);
    }

    public function getOrderByNumber(Request $request, string $order_number) {
        $order = Order::with('items', 'client')->where('order_number', $order_number)->first();
        return response()->json($order);
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'order_number' => 'required|unique:orders',
            'status' => 'required',
            'discount' => 'nullable|numeric',
            'total_price' => 'required|numeric'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $order = Order::create($request->all());

        $order_items = json_decode($request->order_items, true);
        foreach ($order_items as $item) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->name_ar = $item['name_ar'];
            $order_item->name_en = $item['name_en'];
            $order_item->description_ar = $item['description_ar'];
            $order_item->description_en = $item['description_en'];
            $order_item->price = $item['price'];
            $order_item->discount = $item['discount'];
            $order_item->quantity = $item['quantity'];
            $order_item->total_price = $item['total_price'];
            $order_item->image = $item['image'];
            $order_item->save();
        }

        return response()->json($order);
    }

    public function update(Request $request, int $id) {
        $updated_order = Order::where('id', $id)->update($request->all());
        return response()->json($updated_order);
    }

    public function destroy(Request $request, int $id) {
        Order::where('id', $id)->delete();
    }
}
