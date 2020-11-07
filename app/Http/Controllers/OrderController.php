<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Exception;

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
        return view('order\confirmation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = session()->pull('orders');  
        $request->merge([
            'user_id' =>$request->user()->id,
            'sub_Total'=> session()->get('sub-total'),
            'grand-Total'=> session()->get('grand-total'),
            'discounts'=> session()->get('totalDiscount'),
        ]);
        $order = Order::create($request->all());
        foreach($products as $product) {   
            $product['order_id'] = $order->id;
            session()->push('orders', $product);
        }
        $orderProducts = session()->get('orders');
        $request->merge([
            'products' => $orderProducts
        ]);
        $order->products()->attach($request->get('products'));
        $order->save();
        //session()->forget('orders');

        return redirect(route('orders.show', $order));
    }

    public static function discount()
    {
        $order = session()->get('orders');
        $subTotal = 0;
        $tax = 0;
        $totalWithTaxes = 0;
        $totalDiscount = 0;
        $offers = [];

        foreach ($order as $id => $details) {
            $subTotal = $subTotal + $details['total'];
            $tax = $subTotal * 0.14;
            $totalWithTaxes = $subTotal + $tax;

            if ($details['product_name'] == 'Shoes') {
                $discount = $details['price'] * 0.10;
                $totalDiscount = $totalDiscount + $discount;
                array_push($offers, "10% off shoes: -" . $discount);
            } else if ($details['product_name'] == 'Jacket') {
                foreach ($order as $id => $item) {
                    if ($item['product_name'] == 'T-shirt' && $item['quantity'] == 2) {
                        $discount = $details['price'] * 0.50;
                        $totalDiscount = $totalDiscount + $discount;
                        array_push($offers, "50% off jacket: -" . $discount);
                    }
                }
            }
        }
        
        session()->put('tax', round($tax, 2));
        session()->put('sub-total', round($subTotal, 2));
        session()->put('totalDiscount',  round($totalDiscount, 2));
        $grandTotal = $totalWithTaxes - $totalDiscount;
        session()->put('grand-total',  round($grandTotal, 2));
        session()->put('discounts', $offers);
        return round($subTotal, 2);
    }

    public static function convert($price, $currency)
    {
        $req_url = 'https://v6.exchangerate-api.com/v6/9f11d902499873a040b2bb13/latest/USD';
        $response_json = file_get_contents($req_url);

        if (false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if ('success' === $response->result) {
                        $base_price = $price; 
                        $converted = round(($base_price * $response->conversion_rates->$currency), 2);
            
                //print_r($converted);
                return $converted;
                }
            } catch (Exception $e) {
                // Handle JSON parse error...
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order.show');
    }

}
