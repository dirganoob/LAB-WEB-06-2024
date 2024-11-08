@extends('layout.master')

@section('title', 'Contact')

@section('content')
    
    <div class="container shadow bg-gray-50 p-16">
        <div class="w-full px-4">
            <div class="max-w-xl mx-auto text-center mt-10">
                <h4 class="font-semibold text-lg mb-2">Contact</h4>
                <h2 class="font-bold text-3xl mb-4">Hubungi Kami</h2>
                <p class="text-md">Hubungi kami untuk pertanyaan, saran, atau bantuan lebih lanjut. Kami siap membantu!</p>
            </div>
        </div>

        <form>
            <div class="w-full lg:w-2/3 lg:mx-auto">
                <div class="w-full px-4 my-10">
                    <label for="name" class="text-base font-semibold">Nama</label>
                    <input type="text" id="name" class="w-full bg-slate-200 p-3 rounded-md focus:outline-none focus:ring-red-500 focus:ring-1 focus:border-red-500">
                </div>
                <div class="w-full px-4 mb-10">
                    <label for="email" class="text-base font-semibold">Email</label>
                    <input type="email" id="email" class="w-full bg-slate-200 p-3 rounded-md focus:outline-none focus:ring-red-500 focus:ring-1 focus:border-red-500">
                </div>
                <div class="w-full px-4 mb-10">
                    <label for="message" class="text-base font-semibold">Pesan dan Saran Anda</label>
                    <textarea id="message" class="w-full bg-slate-200 p-3 rounded-md h-32 focus:outline-none focus:ring-red-500 focus:ring-1 focus:border-red-500"></textarea>
                </div>
                <div class="w-full px-4">
                    <button class="text-base font-semibold text-white bg-red-500 py-3 px-3 rounded-full hover:bg-red-700 w-full">Kirim</button>
                </div>
            </div>
        </form>
    </div>

@endsection