<x-layouts.guest title="Signup Page" bodyClass="page-signup" heading="Sign Up">
    <form action="{{route("register")}}" method="post">
        @csrf
        <div class="form-group">
            <input type="email" placeholder="Your Email" name="email"/>
        </div>
        <div class="form-group">
            <input type="password" placeholder="Your Password" name="password" />
        </div>
        <div class="form-group">
            <input type="password" placeholder="Repeat Password" />
        </div>
        <hr />
        <div class="form-group">
            <input type="text" placeholder="First Name"  name="fname"/>
        </div>
        <div class="form-group">
            <input type="text" placeholder="Last Name" name="lname" />
        </div>
        <div class="form-group">
            <input type="text" placeholder="Phone" name="phone" />
        </div>
    <button class="btn btn-primary btn-login w-full" type="submit">Register</button>
    
        <x-slot:footerLinks>
            Already have an account? -
            <a href="{{route('login')}}"> Click here to login </a>
        </x-slot:footerLinks>
    </form>
</x-base-layout>