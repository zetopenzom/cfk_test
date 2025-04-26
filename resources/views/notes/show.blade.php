<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lembur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-alert-success>{{ session('success') }}</x-alert-success>
            <div class="flex gap-6">
                <p class="opacity-70"><strong>Dibuat:</strong> {{ $note->created_at->diffForHumans() }}</p>
                <p class="opacity-70"><strong>Terakhir diubah:</strong> {{ $note->updated_at->diffForHumans() }}</p>
                <x-link-button href="{{ route('notes.edit', $note) }}" class="ml-auto">Edit</x-link-button>
                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @method('delete')
                    @csrf
                    <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600" onclick="return confirm('delete?')">Delete</x-primary-button>
                </form>
            </div>
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl text-indigo-600">
                    <a href="{{ route('notes.show', $note) }}" class="hover:underline">{{ $note->title }}</a>
                </h2>
                <p class="mt-2">Mulai : {{ date('d F Y H:i', strtotime($note->start_time)) }}</p>
                <p class="mt-2">Selesai : {{ date('d F Y H:i', strtotime($note->end_time)) }}</p>
                @php
                    $unix = strtotime($note->end_time)-strtotime($note->start_time);
                    $jam = floor($unix / (60 * 60));
                    $menit = ($unix/60) % 60;
                @endphp
                <p class="mt-2">Lembur selama {{ $jam }} jam {{ $menit }} menit</p>
                <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</x-app-layout>
