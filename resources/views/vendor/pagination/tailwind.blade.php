{{-- $paginator variale which is an object which is available to us. It has bunch of methods --}}
@if($paginator->hasPages())
    <nav class="flex justify-center" role="navigation">
        {{-- Prev Link --}}
        @if($paginator->onFirstPage())
<span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-l-lg">Previous</span>
        @else
<a href="{{$paginator->previousPageUrl()}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-l-lg">Previous</a>
        @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span aria-disabled="true">
                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $element }}</span>
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $page }}</span>
                        </span>
                    @else
                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach
         {{-- Next Link --}}
         @if($paginator->hasMorePages())
         <a href="{{$paginator->nextPageUrl()}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-r-lg">Next</a>
        @else
        <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-r-lg">Next</span>
        @endif
    </nav>
@else

@endif