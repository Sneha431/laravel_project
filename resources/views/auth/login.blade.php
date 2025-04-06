<x-layouts.guest title="Login Page" bodyClass="page-login" heading="Login">
<form action="{{route("login.post")}}" method="post">
    @csrf
    <div class="form-group">
        <input type="email" placeholder="Your Email" name="email" />
    </div>
    <div class="form-group">
        <input type="password" placeholder="Your Password" name="password"/>
    </div>
    <div class="text-right mb-medium">
        <a href="{{route("password.reset")}}" class="auth-page-password-reset">Reset Password</a>
    </div>
<button class="btn btn-primary btn-login w-full" type="submit">Login</button>
    {{-- <x-slot:buttonTitle>Login</x-slot:buttonTitle> --}}

   
    <x-slot:footerLinks>
        Don't have an account? -
        <a href="{{route('signup')}}"> Click here to create one</a>
    </x-slot:footerLinks>
</form>
</x-layouts.guest>