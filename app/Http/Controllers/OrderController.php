<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order\show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->merge([
        //     'user_id' => $request->user()->id
        // ]);
    
        // //print_r($request);
        // // Order::create($request->all());
        // // foreach ($sessionOrder as $id => $details){
        // //     $order = [
        // //     "product-id" => $details['id'] ,
        // //     "product-name" => $details['name'] , 
        // //     "quantity" => $details['quantity'] ,
        // //     "price" => $details['price'] , 
        // //     "total" =>$details['total'] ];
        //     $orders = Order::create($request->all());
        //    // $id = $orders['primaryKey'];
        //     //print_r($orders);
        //     $sessionOrder = session()->get('orders');
        //     $orders->products()->attach($sessionOrder);
        //     print_r($sessionOrder);

            // $orders->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
