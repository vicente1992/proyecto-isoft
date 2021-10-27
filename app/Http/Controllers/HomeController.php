<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use App\Models\User;
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


        $data = (object) array(
            'products' => $products,
            'users' => $users,
            'bills' => $bills,
        );

        return view('home', compact('data'));
    }
}
