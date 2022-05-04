<x-app-layout>
    <div class="mx-auto flex max-w-2xl flex-col items-center">
        <h2 class="text-center text-4xl font-semibold leading-tight">
            {{ __('Adicione um método de pagamento para concluir a compra') }}
        </h2>

        <form id="setup-form" action="{{ route('produto.purchase', request()->route('product')) }}" method="POST"
            class="mt-4 w-[500px] max-w-full">
            <div id="setup-element">
                <!--Stripe.js injects the Payment Element-->
            </div>

            <x-button type="submit" class="mx-auto mt-4">Adicionar método de pagamento</x-button>
            @csrf
            @method('POST')
        </form>
    </div>

    <script type="application/json" id="stripe-keys">
        {
            "setup_intent_secret": "{{ $setup_intent_secret }}",
            "stripe_pub_key": "{{ env('STRIPE_KEY') }}"
        }
    </script>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="/js/stetup-card-page.js"></script>
</x-app-layout>
