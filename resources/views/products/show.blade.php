<x-app-layout>
    <div class="bg-white rounded-lg p-3 md:p-5">
        <div class="flex items-start gap-4 md:gap-6 flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                <img src="{{ $product->image_url }}" class="rounded-md w-full">
            </div>
            <div class="flex-1">
                @isset($product->bought_at)
                    <div class="bg-green-500 text-white rounded-md px-2 py-1 mb-2 inline-block">✓ {{ __('Vendido') }}</div>
                @endisset
                <h2 class="text-3xl font-bold mb-2">{{ $product->title }}</h2>
                <div class="text-xl">
                    @isset($product->discount)
                        <span class="text-green-500 font-semibold">{{ money($product->price - $product->discount) }}</span>
                        <span class="text-base line-through text-gray-400">{{ money($product->price) }}</span>
                    @else
                        <span>{{ money($product->price) }}</span>
                    @endisset
                </div>

                <form action="/" method="post" class="my-4">
                    <x-button :disabled="isset($product->bought_at)">{{ __('Comprar') }}</x-button>
                </form>

                <div class="mt-5 flex flex-col gap-3">
                    <div>
                        <div class="uppercase text-sm">Vendedor:</div>
                        <div>{{ $product->seller->name }}</div>
                    </div>
                    <div>
                        <div class="uppercase text-sm">Tamanho:</div>
                        <div>{{ $product->size }}</div>
                    </div>
                    <div>
                        <div class="uppercase text-sm">Condição:</div>
                        <div>{{ $product->condition }}</div>
                    </div>
                </div>

                @isset($product->description)
                    <p class="prose text-gray-800 mt-4">{{ $product->description }}</p>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
