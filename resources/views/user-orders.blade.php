<x-app-layout>
    <h2 class="mb-4 text-3xl font-semibold leading-tight text-gray-800">
        {{ __('Seu histórico de compras') }}
    </h2>

    <div class="overflow-hidden rounded-md bg-white">
        <table class="min-w-full">
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-b bg-transparent transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="whitespace-nowrap px-5 py-4 text-sm font-light text-gray-900">
                            <img src="{{ $product->image_url }}" loading="lazy"
                                class="inline h-[42px] w-[42px] object-cover">
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-light font-bold text-gray-900">
                            {{ $product->title }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-light text-gray-900">
                            {{ money($product->price) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($products->isEmpty())
        <div class="text-center text-base opacity-70">{{ __('Você ainda não comprou nada.') }}</div>
    @endif
</x-app-layout>
