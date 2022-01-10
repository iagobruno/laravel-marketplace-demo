<?php

namespace App\Traits;

trait StripeMethods
{
    public function getOrCreateStripeCustomer()
    {
        if (isset($this->stripe_customer_id)) {
            return $this->retrieveStripeCustomer();
        } else {
            return $this->createStripeCustomer();
        }
    }

    public function retrieveStripeCustomer()
    {
        return \Stripe\Customer::retrieve($this->stripe_customer_id);
    }

    public function createStripeCustomer($data = [])
    {
        $customer = \Stripe\Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            // 'phone' => $this->phone,
            // 'metadata' => []
            ...$data
        ]);
        $this->update([
            'stripe_customer_id' => $customer->id
        ]);
        return $customer;
    }

    public function attachPaymentMethod(string $payment_method_id)
    {
        if (!isset($this->stripe_customer_id)) {
            $this->createStripeCustomer();
        }

        $this->detachCurrentPaymentMethod();

        // Check if pm exists and attach to current costumer
        \Stripe\PaymentMethod::retrieve($payment_method_id)->attach([
            'customer' => $this->stripe_customer_id,
        ]);

        $this->stripe_payment_method_id = $payment_method_id;
        $this->save();
    }

    public function detachCurrentPaymentMethod()
    {
        if (!isset($this->stripe_payment_method_id)) return;

        \Stripe\PaymentMethod::retrieve($this->stripe_payment_method_id)->detach();

        $this->stripe_payment_method_id = null;
        $this->save();
    }
}
