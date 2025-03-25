<x-layouts.guest title="Login Page" bodyClass="page-login" heading="Login">
<form action="" method="post">
    <div class="form-group">
        <input type="email" placeholder="Your Email" />
    </div>
    <div class="form-group">
        <input type="password" placeholder="Your Password" />
    </div>
    <div class="text-right mb-medium">
        <a href="/password-reset.html" class="auth-page-password-reset">Reset Password</a>
    </div>

    <x-slot:buttonTitle>Login</x-slot:buttonTitle>

   
    <x-slot:footerLinks>
        Don't have an account? -
        <a href="{{route('auth.signup')}}"> Click here to create one</a>
    </x-slot:footerLinks>
</form>
</x-layouts.guest>