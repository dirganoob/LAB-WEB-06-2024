@extends('layouts.main')
@section('content')
<section class="gallery" id="gallery">
    <div class="gallery-content">
        <h1 style="color: black;">Gallery</h1>
        <div>
            <img src="{{ asset("Image/Foto1.jpeg")}}" alt="">
            <img src="{{ asset("Image/Foto2.jpeg")}}" alt="">
            <img src="{{ asset("Image/Foto3.jpeg")}}" alt="">
            <img src="{{ asset("Image/Foto4.jpeg")}}" alt="">
            <img src="{{ asset("Image/Foto5.jpeg")}}" alt="">
            <img src="{{ asset("Image/Foto6.jpeg")}}" alt="">
        </div>
    </div>
</section>
@endsection

