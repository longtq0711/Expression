<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RestaurantOrderController extends Controller
{
    public function index($id)
    {
        $resto = Restaurant::find($id);

        if (!$resto) {
            abort(404, 'The restaurant you are looking for is not present');
        }

        $orders = Order::where('resto_id', $id)->paginate(10);
        
        return view('orders.index')->with('orders', $orders)->with('resto', $resto);
    }

    public function add($id)
    {
        $resto = Restaurant::find($id);

        return view('orders.add')->with('resto', $resto);
    }

    public function store(Request $request)
    {
        $postData = $request->all();
        
        $itemIds = $postData['order_data']['orderedItems'];

        try {
            DB::beginTransaction();

            $orderTotal = 0;

            foreach($itemIds as $id) {
                $menu = Menu::query()
                    ->where('resto_id', $postData['resto_id'])
                    ->where('id', $id)
                    ->first();

                if ($menu) {
                    $orderTotal += $menu->price;
                }
            }

            $order = Order::create([
                'resto_id' => $postData['resto_id'],
                'user_id' => Auth::user()->id,
                'amount' => $orderTotal,
                'isComplete' => 0,
                'order_details' => [
                    'items' => $postData['order_data']['orderedItems'],
                    'customer_name' => $postData['order_data']['customerDetails']['name'],
                    'customer_phone' => $postData['order_data']['customerDetails']['phone'],
                    'customer_address' => $postData['order_data']['customerDetails']['address'],
                ]
            ]);

            DB::commit();
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json($order, 201);
    }

}
