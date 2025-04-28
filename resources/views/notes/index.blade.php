<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Administrasi Lembur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-alert-success>{{ session('success') }}</x-alert-success>
            @if (Auth::user()->role == 'Supervisor')
                <x-link-button href="{{ route('notes.create') }}">
                    + Lembur baru
                </x-link-button>
            @endif

            @forelse ($notes as $note)
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex gap-6">
                    <div>
                        <h2 class="font-bold text-2xl text-indigo-600">{{ $note->title }}</h2>
                        <p class="mt-2">Mulai : {{ date('d F Y H:i', strtotime($note->start_time)) }}</p>
                        <p class="mt-2">Selesai : {{ date('d F Y H:i', strtotime($note->end_time)) }}</p>
                        @php
                            $unix = strtotime($note->end_time)-strtotime($note->start_time);
                            $jam = floor($unix / (60 * 60));
                            $menit = ($unix/60) % 60 . " menit";
                            if ($menit == "0 menit") {
                                $menit = "";
                            }
                        @endphp
                        <p class="mt-2">Lembur selama {{ $jam }} jam {{ $menit }}</p>
                        <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
                        {{-- status --}}
                        @if ($note->status == 0)
                            <p class="mt-4 px-2 py-1 bg-yellow-100 border border-yellow-200 text-yellow-700 rounded-md">
                                Lembur belum disetujui
                            </p>
                        @elseif ($note->status == 1)
                            <p class="mt-4 px-2 py-1 bg-green-100 border border-green-200 text-green-700 rounded-md">
                                Lembur telah disetujui
                            </p>
                        @elseif ($note->status == 2)
                            <p class="mt-4 px-2 py-1 bg-red-100 border border-red-200 text-red-700 rounded-md">
                                Lembur ditolak
                            </p>
                        @endif
                    </div>
                    <div class="ml-auto">
                        <div><x-link-button href="{{ route('notes.show', $note) }}" class="ml-auto mt-4 bg-blue-500 hover:bg-blue-600 focus:bg-blue-600">Lihat</x-link-button></div>
                        {{-- supervisor --}}
                        @if (Auth::user()->role == 'Supervisor')
                            @if ($note->status == 0)
                                <x-link-button href="{{ route('notes.edit', $note) }}" class="ml-auto mt-4">Edit</x-link-button>
                                <form action="{{ route('notes.destroy', $note) }}" method="post" class=" mt-4">
                                    @method('delete')
                                    @csrf
                                    <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600" onclick="return confirm('Hapus {{ $note->title }}?')">Hapus</x-primary-button>
                                </form>
                            @endif
                        {{-- manajer --}}
                        @elseif (Auth::user()->role == 'Manajer')
                            @if ($note->status == 0)
                                {{-- button setuju --}}
                                <form action="{{ route('notes.update', $note, 1) }}" method="post" class=" mt-4">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="1">
                                    <x-primary-button class="bg-green-500 hover:bg-green-600 focus:bg-green-600" onclick="return confirm('Setujui {{ $note->title }}?')">Setujui</x-primary-button>
                                </form>
                                {{-- button tolak --}}
                                <form action="{{ route('notes.update', $note, 2) }}" method="post" class=" mt-4">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="2">
                                    <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600" onclick="return confirm('Tolak {{ $note->title }}?')">Tolak</x-primary-button>
                                </form>
                            @endif
                            @if ($note->status != 0)
                            {{-- button batalkan --}}
                            <form action="{{ route('notes.update', $note, 0) }}" method="post" class=" mt-4">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="0">
                                <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-600" onclick="return confirm('Batalkan persetujuan {{ $note->title }}?')">Batalkan</x-primary-button>
                            </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <p>You have no notes yet.</p>
            @endforelse
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
