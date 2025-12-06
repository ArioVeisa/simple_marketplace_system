<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">{{ __('Create Product') }}</h2>
    </x-slot>

    <div class="max-w-2xl animate-fade-in">
        @if ($errors->any())
            <div class="alert-error mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="glass-card p-6">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" :value="old('name')" required />
                </div>

                <div>
                    <x-input-label for="category_id" :value="__('Category')" />
                    <select name="category_id" id="category_id" class="input-dark w-full px-4 py-3">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" id="description" rows="4" class="input-dark w-full px-4 py-3">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" :value="old('price')" required />
                    </div>
                    <div>
                        <x-input-label for="stock" :value="__('Stock')" />
                        <x-text-input id="stock" name="stock" type="number" :value="old('stock')" required />
                    </div>
                </div>

                <div>
                    <x-input-label for="image" :value="__('Image (Optional)')" />
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-dark-800 border border-dark-600 rounded-xl text-dark-100 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-accent file:text-dark-900 file:font-medium hover:file:bg-accent-light file:transition-colors file:cursor-pointer">
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <x-primary-button>
                        Create Product
                    </x-primary-button>
                    <a href="{{ route('products.index') }}" class="text-dark-400 hover:text-dark-200 transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
