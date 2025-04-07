@props(["heading" => "", "title" => "", "bodyClass" => ""])
<x-base-layout :$title :$bodyClass :$heading>
    @if(Session::has('success'))

        <div class="container my-large">
            <div class="success-message">{{Session::get('success')}}</div>
        </div>

    @elseif(Session::has('error'))
        <div class="container my-large">
            <div class="error-message">{{Session::get('error')}}</div>
        </div>
    @endif
     @if($errors->any())
 <div class="container my-large">
    <div class="error-message"> 
      <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    </div>
  
@endif
    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <div class="text-center">
                        <a href="{{route('home.index')}}">
                            <img src="/img/logoipsum-265.svg" alt="" />
                        </a>
                    </div>
                    <h1 class="auth-page-title">{{$heading}}</h1>

                    {{$slot}}
                    {{-- <button class="btn btn-primary btn-login w-full" type="submit">{{$buttonTitle}}</button> --}}
                    @if ($heading == "Login" || $heading == "Sign Up")
                    <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                        <x-google-button></x-google-button>
                        <x-fb-button></x-fb-button>
                    </div>
@endif
                    <div class="login-text-dont-have-account">
                       {{$footerLinks}}
                    </div>
                </div>
                
                <div class="auth-page-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                </div>
            </div>
        </div>
    </main>
</x-base-layout>