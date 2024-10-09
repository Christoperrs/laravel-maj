@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><strong>Product Information</strong></span>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">

                <!-- Display Product Name -->
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end"><strong>Name:</strong></label>
                    <div class="col-md-6 d-flex align-items-center">
                        {{ $product->name }}
                    </div>
                </div>

                <!-- Display Product Description -->
                <div class="row mb-3">
                    <label for="description" class="col-md-4 col-form-label text-md-end"><strong>Description:</strong></label>
                    <div class="col-md-6 d-flex align-items-center">
                        {{ $product->description }}
                    </div>
                </div>

                <!-- Display Product Image -->
                <div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label text-md-end"><strong>Image:</strong></label>
                    <div class="col-md-6 d-flex align-items-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" width="200">
                        @else
                            <span>No image available</span>
                        @endif
                    </div>
                </div>

                <!-- Display Parts Related to Product -->
                <div class="row mt-4">
                    <label for="parts" class="col-md-4 col-form-label text-md-end"><strong>Parts:</strong></label>
                    <div class="col-md-6">
                        @if($product->parts->isNotEmpty())
                            <ul class="list-unstyled">
                                @foreach($product->parts as $part)
                                    <li>- {{ $part->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No parts available for this product.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
