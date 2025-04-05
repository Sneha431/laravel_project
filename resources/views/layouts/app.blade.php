@props(["title" => "", "footerLinks" => "", "bodyClass" => null])
{{-- <x-base-layout :title="$title"> --}}
  <x-base-layout :$title :$bodyClass>
<x-layouts.header></x-layouts.header>
  @if(Session::has('success'))
    
    <div class="container my-large">
    <div class="success-message">{{Session::get('success')}}</div>
    </div>
  @endif
{{$slot}}
{{-- <footer>
<a href="#">Link 1</a>
  <a href="#">Link 2</a>
  {{$footerLinks}}
</footer> --}}

</x-base-layout>