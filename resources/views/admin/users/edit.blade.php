<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">{{ __('Edit User') }}</h2>
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
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password (leave blank to keep current)')" />
                    <x-text-input id="password" name="password" type="password" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" />
                </div>

                <div>
                    <x-input-label :value="__('Roles')" />
                    <div class="grid grid-cols-2 gap-3 mt-2">
                        @foreach($roles as $role)
                            <label class="flex items-center gap-3 p-3 rounded-xl bg-dark-700/50 border border-dark-600 cursor-pointer hover:border-accent/30 transition-colors">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }} class="w-4 h-4 rounded border-dark-600 bg-dark-700 text-accent focus:ring-accent/30 focus:ring-offset-0">
                                <span class="text-dark-200 capitalize">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <x-primary-button>
                        Update User
                    </x-primary-button>
                    <a href="{{ route('users.index') }}" class="text-dark-400 hover:text-dark-200 transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
