<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg max-w-3xl">
                <form action="{{ route('users.update', $user) }}" method="post">
                    @method('put')
                    @csrf
                    {{-- name --}}
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" name="name" class="w-full" placeholder="Nama Pengguna" value="{{ @old('name', $user->name) }}"></x-text-input>
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    {{-- email --}}
                    <x-input-label for="email" :value="__('Email')" class="mt-6" />
                    <x-text-input id="email" name="email" class="w-full" placeholder="Email Pengguna" value="{{ @old('email', $user->email) }}" type="email"></x-text-input>
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    {{-- role --}}
                    <x-input-label for="role" :value="__('Role')" class="mt-6" />
                    <x-input-select id="role" name="role" class="w-full" value="{{ @old('role', $user->role) }}">{{ $user->role }}</x-input-select>
                    @error('role')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    {{-- button --}}
                    <x-primary-button class="mt-6">Simpan</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
