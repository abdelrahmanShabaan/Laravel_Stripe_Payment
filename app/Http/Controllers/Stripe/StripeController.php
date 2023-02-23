<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     * 
     * Here we will make method named Stripe
     * and this will return view from folder resources named Stripe
     */
    public function stripe()
    {
        return view('Stripe.stripe');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     * Here we can added StripePost Mehod take request param as toke from client 
     * and we will make :: setApiKey with same name of stripe secrit that have secrit key 
     * and will make charge with amount of cost and currecy of using and source of blade will tocken
     * and small description what we do
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            'amount' => 100*100,
            'currency' => "USD",
            'source' => $request->stripeToken,
            'description' => 'Test from developer'
        ]);

        /**
         *  if process success we can sent session success
         * and make return to back  blade view 
         */
        Session::flash('success' , 'payment has been success');
        return back();
    }

}
