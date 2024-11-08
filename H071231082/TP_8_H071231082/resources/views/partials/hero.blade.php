@if(request()->routeIs('home'))
<section class="hero-section text-center">
    <div class="container" id="hero">
        <h1 class="display-3 fw-bold">Hello! I'm Imam</h1>
        <h1 class="display-4">Welcome to My Page!</h1>
        <div class="mt-4">
            <a href="{{ route('about') }}" class="btn btn-light btn-lg me-3">Learn More</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Contact Me</a>
        </div>
    </div>
</section>
@endif