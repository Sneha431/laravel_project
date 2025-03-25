<x-layouts.guest title="Signup Page" bodyClass="page-signup" heading="Sign Up">
    <form action="" method="post">
        <div class="form-group">
            <input type="email" placeholder="Your Email" />
        </div>
        <div class="form-group">
            <input type="password" placeholder="Your Password" />
        </div>
        <div class="form-group">
            <input type="password" placeholder="Repeat Password" />
        </div>
        <hr />
        <div class="form-group">
            <input type="text" placeholder="First Name" />
        </div>
        <div class="form-group">
            <input type="text" placeholder="Last Name" />
        </div>
        <div class="form-group">
            <input type="text" placeholder="Phone" />
        </div>
        <x-slot:buttonTitle>Register</x-slot:buttonTitle>
    
        <x-slot:footerLinks>
            Already have an account? -
            <a href="{{route('auth.login')}}"> Click here to login </a>
        </x-slot:footerLinks>
    </form>
</x-base-layout>