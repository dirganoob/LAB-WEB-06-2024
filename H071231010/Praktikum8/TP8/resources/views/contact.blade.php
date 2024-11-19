@extends('layout.master')

@section('title', 'contact')

@section('content')
<div style="padding: 140px; background-image: url('/bg.png'); background-size: cover; background-position: center; color: #FFFFFF;">
    <div style="padding: 30px; display: flex; align-items: center; text-align: left;">
        <div style="flex: 1; text-align: left;">
            <h1 style="font-size: 36px;">Contact Us</h1> 
            <p style="font-size: 20px;"><i class="bi bi-telephone-fill"></i> +62 888 888 888</p>
            <p style="font-size: 20px;"><i class="bi bi-envelope-fill"></i> mycoffeeshop@gmail.com</p>
            <p style="font-size: 20px;"><i class="bi bi-instagram"></i> MyCoffeeShop</p>
        </div>
        <div style="flex: 2; display: flex; flex-wrap: wrap; justify-content: flex-end; padding-left: 20px;">
            <img src="/g1.jpg" alt="Image 1" style="max-width:30%; height: auto; border-radius: 50%; margin: 10px;">
            <img src="/g2.jpg" alt="Image 2" style="max-width:30%; height: auto; border-radius: 50%; margin: 10px;">
            <img src="/g3.jpg" alt="Image 3" style="max-width:30%; height: auto; border-radius: 50%; margin: 10px;">
        </div>
    </div>
</div>
@endsection
