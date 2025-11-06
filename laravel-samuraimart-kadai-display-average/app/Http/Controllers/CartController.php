<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class CartController extends Controller
{


    public function index()
    {
        $cart = Cart::instance(Auth::user()->id)->content();

        $total = 0;
        $has_carriage_cost = false;
        $carriage_cost = 0;

        foreach ($cart as $c) {
            $total += $c->qty * $c->price;
            if ($c->options->carriage) {
                $has_carriage_cost = true;
            }
        }

        if ($has_carriage_cost) {
            $total += env('CARRIAGE');
            $carriage_cost = env('CARRIAGE');
        }

        return view('carts.index', compact('cart', 'total', 'carriage_cost'));
    }



    public function store(Request $request)
    {
        Cart::instance(Auth::user()->id)->add(
            [
                'id' => $request->id,
                'name' => $request->name,
                'qty' => $request->qty,
                'price' => $request->price,
                'weight' => $request->weight,
                'options' => [
                    'image' => $request->image,
                    'carriage' => $request->carriage,
                ]
            ]
        );

        return to_route('products.show', $request->get('id'));
    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
