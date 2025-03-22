<!DOCTYPE html>
<html lang="{{str_replace("_", "-", app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- csrf_token() is a built-in Laravel function that generates a
     CSRF (Cross-Site Request Forgery) token to protect forms
    and requests from unauthorized attacks. --}}
    <meta name="csrf" content="{{csrf_token()}}">
    <title>@yield("title") | {{config("app.name")}}</title>
</head>
<body>
    <header>Header</header>
    @yield("content")
    <footer>Footer</footer>
</body>
</html>