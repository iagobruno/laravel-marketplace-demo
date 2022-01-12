<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StripeController extends Controller
{
    public function redirect()
    {
        $user = Auth::user();
        $stateToken = Str::random(20);
        session()->put('state', $stateToken);

        $params = [
            'client_id' => config('services.stripe.client_id'),
            'state' => $stateToken,
            'redirect_uri' => route('stripe.callback'),

            'stripe_user[business_type]' => 'individual',
            'stripe_user[first_name]' => $user->first_name,
            'stripe_user[last_name]' => $user->last_name,
            'stripe_user[email]' => $user->email,
            'stripe_user[phone_number]' => '00 000000000',
            // 'stripe_user[url]' => route('profile', [$user]),
            'stripe_user[country]' => 'BR',
            // If we're suggesting this account have the `card_payments` capability,
            // we can pass some additional fields to prefill:
            // 'suggested_capabilities[]' => 'card_payments',
        ];

        return redirect('https://connect.stripe.com/express/oauth/authorize?' . http_build_query($params));
    }

    public function callback(Request $request)
    {
        if (!$request->has('state') || $request->input('state') !== session()->get('state')) {
            return redirect()->route('stripe.setup');
        }
        session()->forget('state');

        $authorized = \Stripe\OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $request->input('code'),
        ]);

        Auth::user()->update([
            'stripe_account_id' => $authorized->stripe_user_id,
            'is_seller' => true,
        ]);

        return redirect()->route('home')
            ->with('success', 'Conta de vendedor configurada com sucesso!');
    }

    public function dashboard()
    {
        if (!Auth::user()->is_seller) {
            return redirect()->route('stripe.setup');
        }

        $loginLink = \Stripe\Account::createLoginLink(Auth::user()->stripe_account_id, [
            'redirect_url' => url()->previous() ?? route('home'),
        ]);

        return redirect($loginLink->url . '#/account');
    }
}
