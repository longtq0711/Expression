<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Services\RestoService;

class RestaurantController extends Controller
{
    public function index(RestoService $restoService)
    {
        $restos = $restoService->userRestoAndTables();

        return view('restaurants.index', compact('restos'));
    }

    public function store(Request $request)
    {
        $formData = $request->all();

        $restaurant = Auth::user()->restaurant()->create($formData);

        return response()->json([
            'status' => 200,
            'message' => __('Add item successfully!'),
            'restaurant' => $restaurant
        ]);
    }
}
