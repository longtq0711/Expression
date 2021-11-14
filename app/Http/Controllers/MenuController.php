<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    public function addMenuItem(Request $request)
    {
        $formData = $request->all();

        $category = Category::where('resto_id', $formData['restoId'])->where('name', $request->category)->firstOrFail();

        $formData['category_id'] = $category->id;
        
        $menu = $category->menus()->create([
            'name' => $formData['name'],
            'price' => $formData['price'],
            'description' => $formData['description'],
            'resto_id' => $formData['restoId']
        ]);

        return response()->json([
            'status' => 200,
            'message' => __('Add item successfully!'),
            'menu' => $menu
        ]);
    }
}
