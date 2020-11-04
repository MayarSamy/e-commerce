<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searched = $request->query('search');
        return view('welcome', [
            'products' => Product::where('name', 'LIKE', "%{$searched}%")
                ->paginate($request->query('limit', 10))
        ]);
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        $order = session()->get('orders');
        $subTotal = session()->get('sub-total');
        // if cart is empty then this the first product
        if (!$order && !$subTotal) {
            $order = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "total" => $product->price,
                    "offer" => $product->offer,
                ]
            ];
            $subTotal = $product->price;
            session()->put('orders', $order);
            session()->put('sub-total', $subTotal);
            print("done");
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($order[$id])) {
            $order[$id]['quantity']++;
            $order[$id]['price'] = $order[$id]['price'];
            $order[$id]['total'] = $order[$id]['price'] * $order[$id]['quantity'];
            session()->put('orders', $order);
            $subTotal = $subTotal + $order[$id]['price'];
            session()->put('sub-total', $subTotal);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $order[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "total" => $product->price,
            "offer" => $product->offer
        ];
        session()->put('orders', $order);
        $subTotal = $subTotal + $product->price;
        session()->put('sub-total', $subTotal);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $order = session()->get('orders');
            if (isset($order[$request->id])) {
                unset($order[$request->id]);
                session()->put('orders', $order);
            }
            session()->flash('success', 'Product removed successfully');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
