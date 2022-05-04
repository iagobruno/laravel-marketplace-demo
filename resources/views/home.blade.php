<x-app-layout>
    <h2 class="mb-4 text-3xl font-semibold leading-tight text-gray-800">
        {{ __('Vitrine') }}
    </h2>

    <div class="grid grid-cols-[repeat(auto-fill,minmax(260px,1fr))] gap-4">
        @foreach ($products as $product)
            <a href="{{ route('produto.show', [$product->slug]) }}"
                class="group relative overflow-hidden rounded-md pt-[100%]">
                <div class="absolute top-2 right-2 z-[3] rounded-md bg-white px-2 py-1 text-sm text-gray-900">
                    <span class="">{{ money($product->price) }}</span>
                </div> <img src="{{ $product->image_url }}" loading="lazy" class="absolute inset-0 z-0 object-cover">
                <div
                    class="absolute bottom-0 left-0 right-0 z-[2] bg-gradient-to-t from-black/60 px-3 pb-2 pt-6 text-white opacity-0 transition-opacity group-hover:opacity-100">
                    <strong class="text-lg leading-3">{{ $product->title }}</strong>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
