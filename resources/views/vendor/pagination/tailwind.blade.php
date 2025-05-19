{{-- resources/views/vendor/pagination/tailadmin.blade.php --}}
@if ($paginator->hasPages())
<nav class="flex items-center justify-between">
    <div class="flex gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <span class="px-3 py-2 text-gray-400 cursor-not-allowed rounded-lg">&laquo;</span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" 
           class="px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span class="px-3 py-2 bg-orange-500 text-white rounded-lg">{{ $page }}</span>
        @else
        <a href="{{ $url }}" class="px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">{{ $page }}</a>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" 
           class="px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">&raquo;</a>
        @else
        <span class="px-3 py-2 text-gray-400 cursor-not-allowed rounded-lg">&raquo;</span>
        @endif
    </div>
</nav>
@endif