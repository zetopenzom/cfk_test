@if(@session('success'))
    <p class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
        {{ $slot }}
    </p>
@elseif (@session('fail'))
    <p class="mb-4 px-4 py-2 bg-red-100 border border-red-200 text-red-700 rounded-md">
        {{ $slot }}
    </p>
@endif