<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckOutRequest;
use Cartalyst\Stripe\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use  Cartalyst\Stripe\Exception\CardErrorException;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //while in development phase practice with this code without making getNumber method below

       // $tax = config('cart.tax')/100;
       // $discount = session()->get('coupon')['discount'] ?? 0;
       // $newSubtotal = (Cart::subtotal() - $discount);
       // $newTax = $newSubtotal * $tax;
       // $newTotal = $newSubtotal + $newTax;

       return view('checkout')->with([
           'discount' => $this->getNumbers()->get('discount'),
           'newTotal' => $this->getNumbers()->get('newTotal'),
           'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
           'newTax' => $this->getNumbers()->get('newTax'),
           'tax' => $this->getNumbers()->get('tax')

       ]);
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
    public function store(CheckOutRequest $request)
    {

          $contents=Cart::content()->map(function($item){
            return $item->model->slug.','.$item->qty;
          })->values()->toJson();


       try {
             \Stripe::setApiKey('sk_test_2jpW8LwKbIY5xxgrnMhoYaLl00rf0C2fvI');
               $charge= \Stripe::charges()->create([
               'amount' => $this->getNumbers()->get('newTotal')/100,
               'currency' => 'usd',
               'source' => $request->stripeToken,
               'description' => 'successful transaction',
               'receipt_email' => $request->email,
               'metadata' => [
                     'contents' => $contents,
                     'quantity' => Cart::instance('default')->count(),
                     'discount' => collect(session()->get('coupon'))->toJson(),
               ],
           ]);
                   
               Cart::instance('default')->destroy();
               session()->forget('coupon');
               // return back()->with('success_message','Your payment is Successful.');
               return redirect()->route('confirmation.index')->with('sucess_message','Your payment is successful');

       } catch (CardErrorException $e) {

           return back()->withErrors('Error!'.$e->getMessage());
                

       }

       

        // \Stripe::setApiKey(env('STRIPE_SECRET'));
        // \Stripe::charges()->create ([
        //         "amount" => 100 * 100,
        //         "currency" => "usd",
        //         "source" => $request->stripeToken,
        //         "description" => "Test payment from itsolutionstuff.com." 
        // ]);

        // return back()->with('success_message','You payment is Successful.');

  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //this function is for new values 
    //of discounts,taxes,total,subtotal

    private function getNumbers()
    {
            $tax = config('cart.tax')/100;
            $discount = session()->get('coupon')['discount'] ?? 0;
            $newSubtotal = (Cart::subtotal() - $discount);
            $newTax = $newSubtotal * $tax;
            $newTotal = $newSubtotal + $newTax;

            return collect([
                   'discount' => $discount,
                   'newTotal' => $newTotal,
                   'newSubtotal' => $newSubtotal,
                   'newTax' => $newTax,
                   'tax' => $tax

            ]);


       
    }
}
