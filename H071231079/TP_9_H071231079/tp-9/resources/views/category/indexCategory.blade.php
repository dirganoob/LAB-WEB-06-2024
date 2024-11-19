@extends('templates/master')

@section('title', 'Data Mahasiswa')

@section('header-button')
    <div class="text-center mb-4">
        <h2 class="h4">List Category</h2>
        <div class="d-flex justify-content-between align-items-center mt-3" style="gap: 20px;">
            <!-- Filter Form -->
            <form method="GET" action="{{ url('/category') }}" class="d-flex align-items-center" style="gap: 10px;">
                <select name="filter" class="form-control" style="max-width: 200px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($allCategories as $cat)
                        <option value="{{ $cat->id }}" {{ request('filter') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-info">Filter</button>
            </form>
            <a href="{{ url('/category/create') }}" class="btn btn-primary d-flex align-items-center" style="height: 40px;">
                Tambah Data
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-hover mt-3" style="font-size: 14px;">
            <thead class="thead-light text-center" style="background-color: #f8f9fa;">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Category</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @forelse ($categories as $category)
                    <tr class="text-center">
                        <td>{{ $i++ }}</td>
                        <td>
                            <a href="{{ url("/category/$category->id") }}" class="text-decoration-none text-primary">
                                {{ $category->id }}
                            </a>
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                            <a href="{{ url("/category/$category->id/edit") }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ url("/category/$category->id") }}" 
                                  onsubmit="return confirm('Apakah kamu yakin ingin menghapus data?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data yang ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
