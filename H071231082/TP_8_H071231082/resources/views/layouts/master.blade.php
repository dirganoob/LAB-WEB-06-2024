<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="d-flex flex-column min-vh-100">
    @include('partials.navbar')
    
    <main class="flex-grow-1">
        @include('partials.hero')
        <div class="container @if(request()->routeIs('home')) @else my-5 @endif">
            @yield('content')
        </div>
    </main>

    @yield('footer')
</body>
</html>