<x-app-layout>
    <h2 class="mb-4 text-3xl font-semibold leading-tight text-gray-800">
        @if ($editMode === true)
            {{ __('Editar produto') }}
        @else
            {{ __('Anunciar novo produto') }}
        @endif
    </h2>

    <div class="rounded-lg bg-white p-3 md:p-5">
        @if ($errors->any())
            <div class="mb-4 rounded-lg border-red-500 bg-red-100 p-3 text-base text-red-600">
                {{ __('Consira os campos abaixo.') }}
            </div>
        @endif

        <div class="flex flex-col items-start gap-4 md:flex-row md:gap-6">
            <div class="w-full md:w-1/2">
                {{-- Product image --}}
            </div>

            <div class="w-full md:flex-1">
                @if ($editMode === true)
                    @can('delete', $product)
                        <div class="mb-3 flex justify-end">
                            <form action="{{ route('produto.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-button>{{ __('Deletar produto') }}</x-button>
                            </form>
                        </div>
                    @endcan
                @endif

                <form method="POST"
                    action="{{ $editMode ? route('produto.update', $product) : route('produto.store') }}"
                    class="flex flex-col items-start gap-4">
                    @method($editMode ? 'PUT' : 'POST')
                    @csrf

                    <div class="w-full">
                        <x-label for="title" :value="__('Título')" />
                        <x-input id="title" class="mt-1 block w-full" type="text" name="title" :value="old('title', $product->title ?? '')" />
                        @error('title')
                            <div class="mt-1 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <x-label for="description" :value="__('Descrição')" />
                        <x-textarea id="description" class="mt-1 block w-full" type="text" name="description"
                            :value="old('description', $product->description ?? '')" />
                        @error('description')
                            <div class="mt-1 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <x-label for="price" :value="__('Preço')" />
                        <x-input id="price" class="mt-1 block" type="number" name="price" :value="old('price', ($product->price ?? 0) / 100)"
                            step="1" />
                        @error('price')
                            <div class="mt-1 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <x-label for="size" :value="__('Tamanho')" />
                        <x-select name="size" id="size">
                            @foreach (['', 'PP', 'P', 'M', 'G', 'GG', 'XG'] as $item)
                                <option value="{{ $item }}"
                                    {{ old('size', $product->size ?? '') === $item ? 'selected' : '' }}>
                                    {{ $item }}</option>
                            @endforeach
                        </x-select>
                        @error('size')
                            <div class="mt-1 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <x-label for="condition" :value="__('Condição')" />
                        <x-select name="condition" id="condition">
                            @foreach (['', 'usado', 'seminovo', 'novo'] as $item)
                                <option value="{{ $item }}"
                                    {{ old('condition', $product->condition ?? '') === $item ? 'selected' : '' }}>
                                    {{ $item }}</option>
                            @endforeach
                        </x-select>
                        @error('condition')
                            <div class="mt-1 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-button type="submit">{{ __('Anunciar!') }}</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
