<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class PurchaseController extends Controller
{
    public function __invoke(Product $product, Request $request)
    {
        /** @var \App\Models\User */
        $user = Auth::user();
        $user->getOrCreateStripeCustomer();

        if (isset($product->bought_at)) {
            return abort(Response::HTTP_FORBIDDEN, 'Produto já foi vendido!');
        }

        if ($request->has('new_pm_id')) {
            $user->attachPaymentMethod($request->input('new_pm_id'));
        }

        if (!$user->stripe_payment_method_id) {
            $setupIntent = \Stripe\SetupIntent::create([
                'customer' => $user->stripe_customer_id,
                'payment_method_types' => ['card'],
            ]);
            return view('setup-card', [
                'setup_intent_secret' => $setupIntent->client_secret,
            ]);
        }

        try {
            DB::transaction(function () use ($product, $user) {
                $product->update([
                    'buyer_id' => $user->id,
                    'bought_at' => now(),
                ]);

                \Stripe\PaymentIntent::create([
                    'currency' => 'brl',
                    'amount' => $product->price,
                    'application_fee_amount' => $product->calcApplicationFee(),
                    'transfer_data' => [
                        'destination' => $product->seller->stripe_account_id,
                    ],
                    'customer' => $user->stripe_customer_id,
                    'payment_method' => $user->stripe_payment_method_id,
                    'confirmation_method' => 'automatic',
                    'confirm' => true,
                ]);
            });
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with([
                'error' => 'Ocorreu um problema ao tentar processar o pagamento.',
            ]);
        }

        return redirect()->route('produto.show', $product)->with([
            'success' => 'Você comprou este produto!'
        ]);
    }
}
