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
                <x-link-button href="{{ route('notes.index') }}">
                    < Kembali
                </x-link-button>
                <p class="opacity-70"><strong>Dibuat:</strong> {{ $note->created_at->diffForHumans() }}</p>
                <p class="opacity-70"><strong>Terakhir diubah:</strong> {{ $note->updated_at->diffForHumans() }}</p>
                @if ($note->status == 0)
                    @if (Auth::user()->role == 'Supervisor')
                        <x-link-button href="{{ route('notes.edit', $note) }}" class="ml-auto">Edit</x-link-button>
                        <form action="{{ route('notes.destroy', $note) }}" method="post">
                            @method('delete')
                            @csrf
                            <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600" onclick="return confirm('delete?')">Delete</x-primary-button>
                        </form>
                    @else
                        <p class="px-2 py-1 bg-yellow-100 border border-yellow-200 text-yellow-700 rounded-md ml-auto">
                            Lembur belum disetujui
                        </p>
                    @endif
                @elseif ($note->status == 1)
                    <p class="px-2 py-1 bg-green-100 border border-green-200 text-green-700 rounded-md ml-auto">
                        Lembur telah disetujui
                    </p>
                @elseif ($note->status == 2)
                    <p class="px-2 py-1 bg-red-100 border border-red-200 text-red-700 rounded-md ml-auto">
                        Lembur ditolak
                    </p>
                @endif
            </div>
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl text-indigo-600">{{ $note->title }}</h2>
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
