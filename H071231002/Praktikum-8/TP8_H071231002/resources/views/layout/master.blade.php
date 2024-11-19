<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TP 8 || @yield('title')</title>
</head>
<body>
    @include('section.navbar')

        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    
    @include('section.footer')
    
</body>
</html>