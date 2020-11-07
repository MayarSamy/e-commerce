<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
//use App\Http\Controllers\Exception;

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
        if (!$order) {
            $order = [
                $id => [
                    "product_id" => $id,
                    "product_name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "total" => $product->price,
                ]
            ];
            session()->put('orders', $order);
            return redirect()->back();
        }

        if (isset($order[$id])) {
            $order[$id]['quantity']++;
            $order[$id]['price'] = $order[$id]['price'];
            $order[$id]['total'] = $order[$id]['price'] * $order[$id]['quantity'];
            session()->put('orders', $order);
            return redirect()->back();
        }

        $order[$id] = [
            "product_id" => $id,
            "product_name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "total" => $product->price,
        ];
        session()->put('orders', $order);
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $order = session()->get('orders');
            if (isset($order[$request->id])) {
                unset($order[$request->id]);
                session()->put('orders', $order);
            }
        }
    }

}
