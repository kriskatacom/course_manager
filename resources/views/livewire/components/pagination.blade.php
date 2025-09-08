@if ($paginator->hasPages())
    <ul class="flex gap-1 items-center">

        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <li class="text-lg w-12 h-12 flex justify-center items-center border rounded opacity-50 cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </li>
        @else
            <li>
                <button wire:click="previousPage" class="text-lg w-12 h-12 flex justify-center items-center border rounded hover:text-white hover:bg-primary hover:border-primary">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </li>
        @endif

        {{-- First page --}}
        @if ($paginator->currentPage() > 1)
            <li>
                <button wire:click="gotoPage(1)" class="text-lg w-12 h-12 flex justify-center items-center border rounded hover:text-white hover:bg-primary hover:border-primary">1</button>
            </li>
        @endif

        {{-- Previous "..." --}}
        @if ($paginator->currentPage() > 4)
            <li><span class="px-3 py-1">...</span></li>
        @endif

        {{-- Pages around current --}}
        @foreach (range(max(1, $paginator->currentPage() - 3), min($paginator->lastPage(), $paginator->currentPage() + 3)) as $page)
            @if ($page == $paginator->currentPage())
                <li><span class="text-lg w-12 h-12 flex justify-center items-center font-semibold border rounded text-white bg-primary border-primary">{{ $page }}</span></li>
            @elseif($page != 1 && $page != $paginator->lastPage())
                <li>
                    <button wire:click="gotoPage({{ $page }})" class="text-lg w-12 h-12 flex justify-center items-center border rounded hover:text-white hover:bg-primary hover:border-primary">{{ $page }}</button>
                </li>
            @endif
        @endforeach

        {{-- Next "..." --}}
        @if ($paginator->currentPage() < $paginator->lastPage() - 3)
            <li><span class="px-3 py-1">...</span></li>
        @endif

        {{-- Last page --}}
        @if ($paginator->currentPage() < $paginator->lastPage())
            <li>
                <button wire:click="gotoPage({{ $paginator->lastPage() }})" class="text-lg w-12 h-12 flex justify-center items-center border rounded hover:text-white hover:bg-primary hover:border-primary">{{ $paginator->lastPage() }}</button>
            </li>
        @endif

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <li>
                <button wire:click="nextPage" class="text-lg w-12 h-12 flex justify-center items-center border rounded hover:text-white hover:bg-primary hover:border-primary">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </li>
        @else
            <li class="text-lg w-12 h-12 flex justify-center items-center border rounded opacity-50 cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </li>
        @endif
    </ul>
@endif
