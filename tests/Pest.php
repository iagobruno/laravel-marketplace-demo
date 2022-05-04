<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createTestCreditCard(string $code = null)
{
    $number = match ($code) {
        'insufficient_funds' => '4000000000009995',
        'expired' => '4000000000000069',
        'card_declined' => '4000000000000002',
        'incorrect_cvc' => '4000000000000127',
        'incorrect_number' => '4242424242424241',
        default => '4242424242424242'
    };

    return \Stripe\PaymentMethod::create([
        'type' => 'card',
        'card' => [
            'number' => $number,
            'exp_month' => 12,
            'exp_year' => now()->addYear()->year,
            'cvc' => '314',
        ],
    ]);
}

function createTestConnectAccount()
{
    return \Stripe\Account::create([
        'type' => 'express',
        'business_type' => 'individual',
        'country' => 'BR',
        'email' => 'test091w90uoijsoijsjask@gmail.com',
        'individual' => [
            'phone' => '+55 00 000000000',
            'email' => 'test091w90uoijsoijsjask@gmail.com',
            'first_name' => 'Lorem',
            'last_name' => 'Ipsum',
            'id_number' => '85701070050',
            'dob' => [
                'day' => 4,
                'month' => 6,
                'year' => 1990,
            ],
            'address' => [
                'country' => 'BR',
                'state' => 'Ceará',
                'city' => 'Cidade dos funcionários',
                'line1' => 'Rua Pedro Antônio de Melo',
                'line2' => '3º Andar',
                'postal_code' => 62375000,
            ],
            'verification' => [
                // TODO: Criar um documento de teste para o Stripe ativar a conta pra receber pagamentos
                'document' => [
                    'back' => '',
                    'front' => '',
                ]
            ],
            'political_exposure' => 'none'
        ],
        'business_profile' => [
            'mcc' => '5734',
            'product_description' => 'Lorem ipsum dolor sit amet',
            'url' => 'https://laravel.com/',
        ],
        'external_account' => [
            'object' => 'bank_account',
            'country' => 'BR',
            'currency' => 'BRL',
            'account_holder_name' => 'Lorem Ipsum',
            'routing_number' => '110-0000',
            'account_number' => '0001234'
        ],
        'capabilities' => [
            'card_payments' => ['requested' => true],
            'transfers' => ['requested' => true],
        ],
        // 'tos_acceptance' => [
        //     'date' => now()->timestamp,
        //     'ip' => '186.225.55.146'
        // ],
    ]);
}
