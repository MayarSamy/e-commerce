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
        // if cart is empty then this the first product
        if (!$order) {
            $order = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "total" => $product->price
                ]
            ];
            session()->put('orders', $order);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($order[$id])) {
            $order[$id]['quantity']++;
            $order[$id]['price'] = $order[$id]['price'];
            $order[$id]['total'] = $order[$id]['price'] * $order[$id]['quantity'];
            session()->put('orders', $order);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $order[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "total" => $product->price
        ];
        session()->put('orders', $order);
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

    public static function discount()
    {
        $order = session()->get('orders');
        $subTotal = 0;
        $tax = 0;
        $totalWithTaxes = 0 ;
        $totalDiscount = 0;
        $offers = [];

        foreach ($order as $id => $details) {
            $subTotal = $subTotal + $details['total'];
            $tax = $subTotal * 0.14;
            $totalWithTaxes = $subTotal + $tax ;

            if ($details['name'] == 'Shoes') {
                $discount = $details['price'] * 0.10;
                $totalDiscount = $totalDiscount + $discount;
                array_push($offers, "10% off shoes: -" . $discount );
            } else if ($details['name'] == 'Jacket') {
                foreach ($order as $id => $item) {
                    if ($item['name'] == 'T-shirt' && $item['quantity'] == 2) {
                        $discount = $details['price'] * 0.50;
                        $totalDiscount = $totalDiscount + $discount;
                        array_push($offers, "50% off jacket: -" . $discount );
                    }
                }
            }
        }
        session()->put('tax', $tax);
        session()->put('sub-total', $subTotal);
        $grandTotal = $totalWithTaxes - $totalDiscount;
        session()->put('grand-total', $grandTotal);
        session()->put('discounts', $offers);
        return $subTotal;
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
