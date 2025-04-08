@props(["title" => "", "footerLinks" => "", "bodyClass" => null])

{{-- <x-base-layout :title="$title"> --}}
  <x-base-layout :$title :$bodyClass>
   
<x-layouts.header></x-layouts.header>
@if (url()->current()!== url('http://127.0.0.1:8000'))
 @if(Session::has('success'))

    
    <div class="success-message">{{Session::get('success')}}</div>
   

  @elseif(Session::has('error'))
  
    <div class="error-message">{{Session::get('error')}}</div>
  
  @endif
  @endif
{{$slot}}
{{-- <footer>
<a href="#">Link 1</a>
  <a href="#">Link 2</a>
  {{$footerLinks}}
</footer> --}}
<x-layouts.footer></x-layouts.footer>
</x-base-layout>