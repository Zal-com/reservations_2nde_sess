<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function checkout(){
        return view('stripe.checkout');
    }

    public function index()
    {
        $intent = auth()->user()->createSetupIntent();

        return view('stripe.index', compact('intent'));
    }

    public function store(Request $request)
    {

        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge(10 * 100, $paymentMethod);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('message', 'Product purchased successfully!');
    }
}
