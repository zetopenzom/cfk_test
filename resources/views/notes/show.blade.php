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
                @php
                    $unix = strtotime($note->end_time)-strtotime($note->start_time);
                    $jam = floor($unix / (60 * 60));
                    $menit = ($unix/60) % 60 . " menit";
                    if ($menit == "0 menit") {
                        $menit = "";
                    }
                @endphp
                <div class="justify-center grid">
                    {{-- logo --}}
                    <img src="{{ asset('/assets/brand/kep-crop-tr.png') }}" alt="Logo" class="w-10 float-right">
                    {{-- header --}}
                    <div class="grid-rows-3 text-center">
                        <div class="text-4xl font-bold mb-5">Surat Perintah Lembur</div>
                        <div class="text-xl">PT. Kaltim Electrik Power</div>
                        <div class="text-l">Desa Tanjung Batu, Kec. Tenggarong Seberang, Kab. Kutai Kartanegara</div>
                        <hr class="my-5" style="border: 1px solid black;">
                    </div>
                    {{-- no.spl --}}
                    <div class="mb-5 font-bold text-center">
                        <i>No.SPL : {{ $note->title }}</i>
                    </div>
                    {{-- kutai + tanggal --}}
                    <div class="mb-5 font-bold text-right">
                        Kutai Kartanegara, {{ date('d F Y', strtotime($note->updated_at)); }}
                    </div>
                    {{-- isi utama --}}
                    <div class="my-5">
                        Dengan hormat,
                    </div>
                    <div class="my-5">
                        Dengan datangnya surat ini, kami menugaskan kepada karyawan PT. Kaltim Electrik Power untuk melakukan lembur pada:
                    </div>
                    <div class="mt-5">
                        Mulai Waktu Lembur : {{ date('j F Y, H:i', strtotime($note->start_time)) }}
                    </div>
                    <div>
                        Selesai Waktu Lembur : {{ date('j F Y, H:i', strtotime($note->end_time)) }}
                    </div>
                    <div class="mb-5">
                        Jumlah Waktu Lembur : {{ $jam }} jam {{ $menit }}
                    </div>
                    <div class="my-5">
                        Demikian surat perintah lembur ini kami sampaikan. Mohon kiranya dapat dilaksanakan sebagaimana mestinya. Atas perhatian saudara, kami ucapkan terima kasih.
                    </div>
                    {{-- footer --}}
                    <div class="my-10">
                        <span>
                            Dibuat oleh :
                        </span>
                        <span class="float-right">
                            Disetujui oleh :
                        </span>
                    </div>
                    <div class="my-10">
                        <span>
                            {{ $spv . ' (Supervisor) ' }}
                        </span>
                        <span class="float-right">
                            {{ $manajer . ' (Manajer) ' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
