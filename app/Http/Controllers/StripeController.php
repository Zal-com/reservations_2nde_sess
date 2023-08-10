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

        $validated = $request->validate([
            'quantity' => 'required|integer|max:10|min:1',
            'representation_id' => 'required|numeric'
        ]);

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

        return redirect()->route('profile.edit')->with('success', 'Votre réservation a bien été enregistrée');
    }

    public function success($id, $qte){
        return redirect()->route('profile.edit')->with('success', 'Votre réservations a bien été enregistrée');
    }

    public function cancel($id){
        $reservation = RepresentationUser::find($id);

        if($reservation->user_id != \Auth::id()){
            return redirect()->to('home')->with('error', 'Vous n\'êtes pas authorisé à faire cela')->status(401);
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        try {
            $stripe->refunds->create([
                'payment_intent' => $reservation->payment_id,
            ]);
        }
        catch (\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        // annuler la reservation et changer un status
        $reservation->status = 0;
        $reservation->save();

        return redirect()->route('profile.edit')->with('success', 'Votre réservations a bien été annulée, vous serez bientôt remboursés');

    }
}
