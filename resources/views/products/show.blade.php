<x-app-layout>
    <div class="rounded-lg bg-white p-3 md:p-5">
        <div class="flex flex-col items-start gap-4 md:flex-row md:gap-6">
            <div class="w-full md:w-1/2">
                <img src="{{ $product->image_url }}" class="w-full rounded-md">
            </div>
            <div class="flex-1">
                @can('update', $product)
                    <div class="mb-3 flex justify-end">
                        <form action="{{ route('produto.edit', $product) }}" method="get" class="inline">
                            <x-button>{{ __('Editar produto') }}</x-button>
                        </form>
                    </div>
                @endcan
                @isset($product->bought_at)
                    <div class="mb-2 inline-block rounded-md bg-green-500 px-2 py-1 text-white">✓ {{ __('Vendido') }}</div>
                @endisset
                <h2 class="mb-2 text-3xl font-bold">{{ $product->title }}</h2>
                <div class="text-xl">
                    @isset($product->discount)
                        <span
                            class="font-semibold text-green-500">{{ money($product->price - $product->discount) }}</span>
                        <span class="text-base text-gray-400 line-through">{{ money($product->price) }}</span>
                    @else
                        <span>{{ money($product->price) }}</span>
                    @endisset
                </div>

                <form action="/" method="post" class="my-4">
                    <x-button :disabled="isset($product->bought_at)">{{ __('Comprar') }}</x-button>
                </form>

                <div class="mt-5 flex flex-col gap-3">
                    <div>
                        <div class="text-sm uppercase">Vendedor:</div>
                        <div>{{ $product->seller->name }}</div>
                    </div>
                    <div>
                        <div class="text-sm uppercase">Tamanho:</div>
                        <div>{{ $product->size }}</div>
                    </div>
                    <div>
                        <div class="text-sm uppercase">Condição:</div>
                        <div>{{ $product->condition }}</div>
                    </div>
                </div>

                @isset($product->description)
                    <p class="prose mt-4 text-gray-800">{{ $product->description }}</p>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
