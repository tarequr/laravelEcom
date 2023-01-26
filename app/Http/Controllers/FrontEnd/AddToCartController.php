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

    public function allCart()
    {
        $data['cat_qty'] = Cart::count();
        $data['cat_total'] = Cart::total();

        return response()->json($data);
    }

    public function myCart()
    {
        $contents = Cart::content();
        // return response()->json($data);
        return view('frontend.cart.cart', compact('contents'));
    }

    public function cartRemove($rowId)
    {
        Cart::remove($rowId);
        return response()->json();

        // notify()->success("Cart Remove Successfully.", "Success");
        // return back();
    }

    public function qtyUpdate($rowId,$qty)
    {
        Cart::update($rowId,['qty' => $qty]);
        return response()->json();
    }

    public function colorUpdate($rowId,$color)
    {
        $product = Cart::get($rowId);
        $size = $product->options->size;
        $thumbnail = $product->options->thumbnail;

        Cart::update($rowId, ['options'  => ['color' => $color, 'size' => $size, 'thumbnail' => $thumbnail]]);
        return response()->json();
    }
}
