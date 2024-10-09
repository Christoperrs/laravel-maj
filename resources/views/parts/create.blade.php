@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Bagian Baru untuk {{ $product->name }}</div>
    <div class="card-body">
        <form action="{{ route('products.parts.store', $product->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Bagian</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Bagian</button>
        </form>
    </div>
</div>
@endsection