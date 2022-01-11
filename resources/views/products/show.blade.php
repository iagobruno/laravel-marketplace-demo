<x-app-layout>
    <div class="bg-white rounded-lg p-3 md:p-5">
        <div class="flex items-start gap-4 md:gap-6 flex-col md:flex-row">
            <div class="w-full md:w-2/5">
                <img src="{{ $product->image_url }}" class="rounded-md w-full">
            </div>
            <div class="flex-1">
                @isset($product->bought_at)
                    <div class="bg-green-500 text-white rounded-md px-2 py-1 mb-2 inline-block">✓ {{ __('Vendido') }}</div>
                @endisset
                <h2 class="text-3xl font-bold mb-2">{{ $product->title }}</h2>
                <p class="text-xl">{{ $product->formattedPrice }}</p>

                <form action="/" method="post" class="my-4">
                    <x-button :disabled="isset($product->bought_at)">{{ __('Comprar') }}</x-button>
                </form>

                <div class="text-gray-800 mt-5">
                    <div class="uppercase text-sm">Vendedor:</div>
                    <div>{{ $product->seller->name }}</div>
                </div>

                @isset($product->description)
                    <p class="prose text-gray-800 mt-3">{{ $product->description }}</p>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
