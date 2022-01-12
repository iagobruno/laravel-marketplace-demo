<x-app-layout>
    <div class="flex flex-col items-center max-w-2xl mx-auto">
        <h2 class="font-semibold text-4xl leading-tight">
            {{ __('Torne-se um vendedor!') }}
        </h2>

        <p class="mt-3 mb-6 text-lg text-center">
            {{ __('Começe a vender hoje mesmo seus produtos e faça uma renda extra.') }}
        </p>

        <form action="{{ route('stripe.redirect') }}" method="POST">
            @csrf
            <x-button type="submit">{{ __('Configurar conta de pagamentos') }}</x-button>
        </form>

        <p class="text-gray-500 text-center text-sm mt-3">
            {{ __('Você será redirecionado para o formulário do Stripe.') }}</p>
    </div>
</x-app-layout>
