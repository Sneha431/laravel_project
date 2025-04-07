<x-layouts.guest title="Reset Password Page" bodyClass="page-login" heading="Reset Password">
<form action="{{ route('password.edit') }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <input type="email" placeholder="Your Email" name="email" />
    </div>
    <div class="form-group">
        <input type="password" placeholder="Your Password" name="password"/>
    </div>

    <button class="btn btn-primary btn-login w-full" type="submit">Request password reset</button>

   
</form>

 <x-slot:footerLinks>
        Already have an account? -
        <a href="{{ route('login') }}"> Click here to login </a>
    </x-slot:footerLinks>
</x-layouts.guest>