@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Log Inventaris</h1>
    <a href="{{ route('inventory_logs.create') }}" class="btn btn-success">Tambah Log Inventaris</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Produk</th>
                <th>Jenis Perubahan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventoryLogs as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->product->name }}</td>
                <td>{{ ucfirst($log->type) }}</td>
                <td>{{ $log->quantity }}</td>
                <td>{{ $log->date }}</td>
                <td>
                    <form action="{{ route('inventory_logs.destroy', $log->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus log ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection