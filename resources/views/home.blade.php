<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vitrine') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <a href="/product/{{ $product->slug }}"
                        class="aspect-square rounded-md overflow-hidden relative group">
                        <div class="bg-white text-gray-900 text-sm rounded-md px-2 py-1 absolute top-2 right-2">
                            {{ $product->formattedPrice }}
                        </div>
                        <img src="{{ $product->image_url }}" loading="lazy" class="object-cover aspect-square">
                        <div
                            class="bg-gradient-to-t from-black/60 text-white pb-2 px-3 pt-6 absolute bottom-0 left-0 right-0 transition-opacity opacity-0 group-hover:opacity-100">
                            <strong class="text-lg leading-3">{{ $product->title }}</strong>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
