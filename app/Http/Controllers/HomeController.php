<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Services\MenuService;
use App\Services\RestoService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(MenuService $menuService, RestoService $restoService)
    {
        $restoId = 1;

        $menus = $menuService->getMenuWithCategory($restoId);

        $restos = $restoService->userRestoAndTables();
        // dd($restos);

        return view('home', compact('menus', 'restoId', 'restos'));
    }
}
