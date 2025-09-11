<div>
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-5 my-5">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-5 my-5">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mx-5 my-5">
            {{ session('warning') }}
        </div>
    @endif

    @if (session()->has('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mx-5 my-5">
            {{ session('info') }}
        </div>
    @endif
</div>
