<x-layouts.guest title="Reset Password Page" bodyClass="page-login" heading="Reset Password">
<form action="" method="post">
  <div class="form-group">
    <input type="email" placeholder="Your Email" />
  </div>


<button class="btn btn-primary btn-login w-full" type="submit">Request password reset</button>
  <x-slot:footerLinks>
    Already have an account? -
    <a href="{{route('login')}}"> Click here to login </a>
  </x-slot:footerLinks>
</form>

</x-layouts.guest>