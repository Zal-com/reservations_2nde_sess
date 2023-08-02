<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use App\Models\RepresentationUser;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeController extends Controller
{

    public function index(Request $request)
    {

        $representation = Representation::find($request->get('representation_id'));
        $quantity = $request->get('quantity');

        $intent = auth()->user()->createSetupIntent();

        return view('stripe.index', [
            'representation' => $representation,
            'quantity' => $quantity,
            'intent' => $intent
        ]);
    }

    public function store(Request $request)
    {

        $user = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $payment = $user->charge($request->get('quantity') * $request->get('unit_price') * 100, $paymentMethod, ['currency' => 'eur']);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        $reservation = new RepresentationUser();
        $reservation->user_id = \Auth::user()->id;
        $reservation->representation_id = $request->get('representation_id');
        $reservation->seats = $request->get('quantity');
        $reservation->unit_price = $request->get('unit_price');
        $reservation->total = $payment->amount/100;
        $reservation->payment_id = $payment->id;

        $reservation->save();

        return redirect()->route('stripe.success', ['id' => $request->get('representation_id'), 'qte' => $request->get('quantity')]);
    }

    public function success($id, $qte){

    }
}
