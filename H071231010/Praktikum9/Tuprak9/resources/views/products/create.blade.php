@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Add New Product</h1>
    <div class="form-container">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" step="0.01" name="price" id="price" min="1" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" name="stock" id="stock" min="0" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
