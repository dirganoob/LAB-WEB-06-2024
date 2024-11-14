@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Log Inventaris</h1>
    <form action="{{ route('inventory_logs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_id">Produk</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Pilih Produk</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="type">Jenis Perubahan</label>
            <select name="type" id="type" class="form-control" required>
                <option value="restock">Restock</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="quantity">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="date">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan Log</button>
        <a href="{{ route('inventory_logs.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection