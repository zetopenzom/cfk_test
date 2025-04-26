<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Administrasi Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-alert-success>{{ session('success') }}</x-alert-success>
            <x-link-button href="{{ route('users.create') }}">
                + Tambah Pengguna
            </x-link-button>
            @forelse ($users as $user)
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex gap-6">
                    <div>
                        <h2 class="font-bold text-2xl text-indigo-600">{{ $user->name }}</h2>
                        <p class="mt-2">{{ $user->email }}</p>
                        <p class="mt-2">{{ $user->role }}</p>
                    </div>
                    <div class="ml-auto">
                        {{-- button --}}
                        <x-link-button href="{{ route('users.edit', $user) }}" class="ml-auto mt-4">Edit</x-link-button>
                        <form action="{{ route('users.destroy', $user) }}" method="post" class=" mt-4">
                            @method('delete')
                            @csrf
                            <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600" onclick="return confirm('Hapus {{ $user->name }}?')">Hapus</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <p>You have no users yet.</p>
            @endforelse
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
