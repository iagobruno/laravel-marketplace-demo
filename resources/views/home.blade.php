<x-app-layout>
    <h2 class="font-semibold text-3xl text-gray-800 mb-4 leading-tight">
        {{ __('Vitrine') }}
    </h2>

    <div class="grid grid-cols-[repeat(auto-fill,minmax(260px,1fr))] gap-4">
        @foreach ($products as $product)
            <a href="{{ route('products.show', [$product->slug]) }}"
                class="aspect-square rounded-md overflow-hidden relative group">
                <div class="bg-white text-gray-900 text-sm rounded-md px-2 py-1 absolute top-2 right-2">
                    @isset($product->discount)
                        <span class="font-semibold text-green-500">{{ money($product->price - $product->discount) }}</span>
                        <span class="text-xs line-through text-gray-400">{{ money($product->price) }}</span>
                    @else
                        <span class="">{{ money($product->price) }}</span>
                    @endisset
                </div>
                <img src="{{ $product->image_url }}" loading="lazy" class="object-cover aspect-square">
                <div
                    class="bg-gradient-to-t from-black/60 text-white pb-2 px-3 pt-6 absolute bottom-0 left-0 right-0 transition-opacity opacity-0 group-hover:opacity-100">
                    <strong class="text-lg leading-3">{{ $product->title }}</strong>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
