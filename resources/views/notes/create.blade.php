<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Lembur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg max-w-3xl">
                <x-alert-success>{{ session('fail') }}</x-alert-success>
                <x-link-button href="{{ route('notes.index') }}">
                    < Kembali
                </x-link-button>
                <form action="{{ route('notes.store') }}" method="post">
                    @csrf
                    {{-- judul --}}
                    <x-input-label for="title" :value="__('Judul')" class="mt-6"/>
                    <x-text-input id="title" name="title" class="w-full" placeholder="Nama Lembur" value="{{ @old('title') }}"></x-text-input>
                    @error('title')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    {{-- start time --}}
                    <x-input-label for="start_time" :value="__('Mulai Waktu Lembur')" class="mt-6" />
                    <x-text-input id="start_time" name="start_time" class="w-full" value="{{ @old('start_time') }}" type="datetime-local"></x-text-input>
                    @error('start_time')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    {{-- end time --}}
                    <x-input-label for="end_time" :value="__('Akhir Waktu Lembur')" class="mt-6" />
                    <x-text-input id="end_time" name="end_time" class="w-full" value="{{ @old('end_time') }}" type="datetime-local"></x-text-input>
                    @error('end_time')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    {{-- button --}}
                    <x-primary-button class="mt-6">Simpan</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
