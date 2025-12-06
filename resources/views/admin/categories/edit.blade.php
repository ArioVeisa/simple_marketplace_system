<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">{{ __('Edit Category') }}</h2>
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
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" :value="old('name', $category->name)" required />
                </div>

                <div>
                    <x-input-label for="image" :value="__('Image (Optional)')" />
                    <input type="file" name="image" id="image" class="w-full px-4 py-3 bg-dark-800 border border-dark-600 rounded-xl text-dark-100 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-accent file:text-dark-900 file:font-medium hover:file:bg-accent-light file:transition-colors file:cursor-pointer">
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <x-primary-button>
                        Update Category
                    </x-primary-button>
                    <a href="{{ route('categories.index') }}" class="text-dark-400 hover:text-dark-200 transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
