@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Part for {{ $product->name }}
    </div>
    <div class="card-body">
        <form action="{{ route('products.parts.update', [$product, $part]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $part->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $part->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Part</button>
            <a href="{{ route('products.parts.index', $product) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
