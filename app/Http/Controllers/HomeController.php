<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use Illuminate\Http\Request;

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
    public function index()
    {
        $products = Product::all()->count();
        $users = User::all()->count();
        $bills = Bill::all()->sum('total_amount');
        $sales = Sale::all()->sum('amount');


        $data = (object) array(
            'products' => $products,
            'users' => $users,
            'bills' => $bills,
            'sales' => $sales,
        );

        return view('home', compact('data'));
    }
}
