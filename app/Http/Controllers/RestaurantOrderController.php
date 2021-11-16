<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Menu;

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
}
