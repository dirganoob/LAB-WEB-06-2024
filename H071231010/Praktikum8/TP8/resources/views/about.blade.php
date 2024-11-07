@extends('layout.master')

@section('title', 'about')

@section('content')

<div class="container-fluid p-0"> 
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="5" aria-label="Slide 6"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="6" aria-label="Slide 7"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="7" aria-label="Slide 8"></button>
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="8" aria-label="Slide 9"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/g4.jpg" class="d-block w-100" alt="Espresso" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Espresso</h5>
                    <p>Espresso adalah kopi pekat yang dibuat dengan mengekstraksi air panas bertekanan tinggi melalui bubuk kopi halus.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/americano.jpg" class="d-block w-100" alt="Americano" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Americano</h5>
                    <p>Americano adalah espresso yang diencerkan dengan air panas, menghasilkan kopi yang lebih ringan namun tetap beraroma.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/longback.jpg" class="d-block w-100" alt="Long Black" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Long Black</h5>
                    <p>Long black adalah espresso yang dituangkan di atas air panas, menghasilkan kopi dengan rasa kuat dan lapisan crema yang utuh.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/cappucino.jpg" class="d-block w-100" alt="Cappucino" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Cappucino</h5>
                    <p>Cappuccino adalah minuman kopi yang terbuat dari espresso, susu panas, dan busa susu dalam proporsi seimbang.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/cl.jpg" class="d-block w-100" alt="Caffee Latte" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Caffee Latte</h5>
                    <p>Café latte adalah minuman kopi yang terbuat dari satu bagian espresso dan tiga bagian susu panas, disajikan dengan sedikit busa susu di atasnya.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/mochalatte.jpg" class="d-block w-100" alt="Mocha Latte" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Mocha Latte</h5>
                    <p>Mocha latte adalah minuman kopi yang terbuat dari espresso, susu panas, dan sirup cokelat, biasanya disajikan dengan krim kocok di atasnya.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/affogato.jpg" class="d-block w-100" alt="Affogato" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Affogato</h5>
                    <p>Affogato adalah pencuci mulut yang terdiri dari satu atau dua scoop es krim yang disiram dengan espresso panas.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/coldbrew.jpg" class="d-block w-100" alt="Cold Brew" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Cold Brew</h5>
                    <p>Cold brew adalah kopi yang diseduh dengan air dingin selama beberapa jam, menghasilkan rasa halus dan rendah asam.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/macchiato.jpg" class="d-block w-100" alt="Macchiato" style="height: 600px; object-fit: cover;"> 
                <div class="carousel-caption d-none d-md-block">
                    <h5>Macchiato</h5>
                    <p>Macchiato adalah espresso yang ditambahkan sedikit busa susu, memberikan rasa kopi yang pekat dengan sentuhan lembut.</p>
                </div>
            </div>
        </div>

        
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev" style="background: none; border: none; color: black; font-size: 30px;">
            <span>&lt;</span> 
            <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next" style="background: none; border: none; color: black; font-size: 30px;">
            <span>&gt;</span> 
            <span class="visually-hidden"></span>
        </button>
    </div>
</div>

@endsection
