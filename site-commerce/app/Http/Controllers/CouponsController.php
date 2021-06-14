<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $coupon = Coupon::where('code',$request->coupon_code)->first();
        
        if (!$coupon) {
            return redirect()->route('checkout.index')->withErrors('Invalid Coupn code.Please! Enter the correct coupon code');
        }

        session()->put('coupon',[
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal())
        ]);
        return redirect()->route('checkout.index')->with('success_message','Coupon has been successfully applied.');
    }

    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
       session()->forget('coupon');

       return redirect()->route('checkout.index')->with('success_message','Coupon has been removed');
    }
}
