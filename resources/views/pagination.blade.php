<?php
/** @var $paginator \Illuminate\Pagination\LengthAwarePaginator */
?>

{{-- {{dd($paginator)}} --}}
@if($paginator->hasMorePages())
            <nav class="pagination my-large">
                @if($paginator->onFirstPage())
                    <span class="pagination-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            style="width: 18px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                        </svg>
                    </span>
                   @else
                       <a href="{{$paginator->previousPageUrl()}}" class="pagination-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            style="width: 18px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                        </svg>
                        </a>
                 @endif
    {{-- {{dd($elements)}} --}}
    @foreach ($elements as $element)
        @if(is_string($element))
         <span class="pagination-item"> {{$element}} </span>
         @endif
         @if(is_array($element))
             @foreach ($element as $page => $url)
                 @if($page == $paginator->currentPage())
                    <a href="{{$url}}" class="pagination-item active"> {{$page}} </a>
                    @else
                        <a href="{{$url}}" class="pagination-item"> {{$page}} </a>
                    @endif
             @endforeach

          @endif
    @endforeach
               
        @if ($paginator->hasMorePages())
            <a href="{{$paginator->nextPageUrl()}}" class="pagination-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    style="width: 18px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                </svg>
            </a>
            @else
                <span class="pagination-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        style="width: 18px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                    </svg>
                </span>
            @endif

            </nav>
@endif