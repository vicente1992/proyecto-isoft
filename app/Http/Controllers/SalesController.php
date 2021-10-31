<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Order;
use Auth;
class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return view('sales.index');
    }

    public function getProducts(Type $var = null)
    {        

        $products = Product::where('quantity', '>', 0)->get();        
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $sale = new Sale();
        $sale->customer = $request->customer;
        $sale->amount = $request->amount;
        $sale->id_customer = $request->idCustormer;
        $sale->seller = $request->seller;       
        $sale->save(); 

        return response()->json([
                'sale' => $sale->id,
                'message' => 'Venta realizada exitosamente',
            ]);
       
    }
    
    public function crateOrder(Request $request)
    { 
        $orders = $request->orders;       
        foreach ($orders as $key => $value) {
           Order::create($value);
        }
        return response()->json('Orders guardada exitosamente');
    }

    public function updateProduct(Request $request, $id)
    { 
                 
        $quantity = $request->quantity;    
        $product = Product::find($id);
        $total__quantity = $product->quantity - $quantity;
         Product::where('id', $product->id)->update(['quantity' => $total__quantity]);
   
        return response()->json('Producto actualizado exitosamente');
    }

    public function getSales(Type $var = null)
    {
        $sales = Sale::join('users', 'sales.seller', '=', 'users.id')
        ->select('sales.*','users.name as sellerName')->orderBy('created_at', 'desc')->paginate(10);       
              
        foreach ($sales as $key => $sale) {
          $sale['order']= Order::where('sale_id', $sale->id)->get();
        }
         return response()->json(['sales' => $sales,]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
