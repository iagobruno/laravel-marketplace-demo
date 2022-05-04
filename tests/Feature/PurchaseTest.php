<?php

// Testar se o usuário é cobrado
// Testar se os fundos são transferidos corretamente para o vendedor e a plataforma

use App\Models\Product;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

test('Deve transferir corretamente os fundos para o vendedor e a taxa da plataforma', function () {
    $sellerStripeAccount = 'acct_1KviF2QXqkqgQs6A';
    $seller = User::factory()->create([
        'stripe_account_id' => $sellerStripeAccount,
        'is_seller' => true
    ]);

    $product = Product::factory()->for($seller, 'seller')->create([
        'price' => 4200
    ]);

    /** @var User */
    $user = User::factory()->create();
    $user->attachPaymentMethod(createTestCreditCard()->id);

    // $applicationBalanceBEFORE = \Stripe\Balance::retrieve()->pending[0]->amount;
    $accountBalanceBEFORE = \Stripe\Balance::retrieve(['stripe_account' => $sellerStripeAccount])->pending[0]->amount;

    actingAs($user)
        ->post(route('produto.purchase', $product))
        // ->dd()
        ->assertSessionHas('success')
        ->assertRedirect();

    $applicationFee = 840;

    // Checa a última transação na plataforma
    $lastTransaction = \Stripe\BalanceTransaction::all(['limit' => 1])->data[0];
    expect($lastTransaction->amount)->toEqual($applicationFee);

    // Checa a última transação na conta conectada
    $lastAccountTransaction = \Stripe\BalanceTransaction::all(
        ['limit' => 1],
        ['stripe_account' => $sellerStripeAccount]
    )->data[0];
    expect($lastAccountTransaction->amount)->toEqual($product->price);
    expect($lastAccountTransaction->fee)->toEqual($applicationFee);

    // Checa o saldo da conta conectada
    $accountBalanceNOW = \Stripe\Balance::retrieve(['stripe_account' => $sellerStripeAccount])->pending[0]->amount;
    expect($accountBalanceNOW)->toEqual($accountBalanceBEFORE + ($product->price - $applicationFee));

    // Checa o saldo da plataforma
    // ! Tem que fazer os cálculos de cobrança de taxa do Stripe. https://stripe.com/br/connect/pricing
    // $applicationBalanceNOW = \Stripe\Balance::retrieve()->pending[0]->amount;
    // dump($applicationBalanceBEFORE, $applicationBalanceNOW, $product->calcApplicationFee());
    // expect($applicationBalanceNOW)->toEqual($applicationBalanceBEFORE + $applicationFee);
});
