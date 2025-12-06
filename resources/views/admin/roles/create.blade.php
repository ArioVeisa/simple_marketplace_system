<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">{{ __('Create Role') }}</h2>
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
            <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Role Name')" />
                    <x-text-input id="name" name="name" type="text" :value="old('name')" required />
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <x-primary-button>
                        Create Role
                    </x-primary-button>
                    <a href="{{ route('roles.index') }}" class="text-dark-400 hover:text-dark-200 transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
