@extends('layout.master')

@section('title', 'Home')

@section('content')

    <div>
        <div class="w-full flex justify-center flex-col shadow md:flex md:flex-row-reverse bg-gray-50" >
            <div class="ms-5 w-72 md:w-auto my-32 px-10">
                <img src="image/prabowo.jpg" alt="Prabowo Subioanto">
            </div>
            <div class="font-medium mt-8 md:mt-12 p-20">
                <p class="lg:text-3xl font-bold font-serif">Prabowo Subianto</p>
                <p class="lg:text-4xl font-serif font-style: italic">Nahkoda Baru, Arah Baru, Menuju <span class="text-red-500">Indonesia Maju</span></p>
                <br>
                <p class="lg:text-base">Periode kepemimpinan baru bagi Indonesia baru saja dimulai. Dengan semangat kebersamaan dan kerja keras, mari kita dukung penuh langkah dan visi pemimpin baru untuk mewujudkan Indonesia yang lebih maju, adil, dan sejahtera. Bersama-sama, kita bisa menghadapi tantangan dan mencapai tujuan yang lebih besar. Saatnya melangkah ke depan dan membangun Indonesia yang lebih baik bagi generasi mendatang.</p>
            </div>
        </div>
    </div>

@endsection