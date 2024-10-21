<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('checkout');
    }
}
