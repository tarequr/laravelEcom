<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;


class AddToCartController extends Controller
{
    public function addToCartQuickView(Request $request)
    {
        $product = Product::find($request->id);
        Cart::add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => $request->qty,
            'price'   => $request->price,
            'weight'  => '1',
            'options' => [
                'size'      => $request->size,
                'color'     => $request->color,
                'thumbnail' => $product->thumbnail
            ]
        ]);

        return response()->json();
    }
}
