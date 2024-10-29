@extends('layouts.app')

@section('content')
        <div class="card">
            <div class="card-header">Edit Part</div>
            <div class="card-body">
                <form id="partsForm" action="{{ route('parts.update', $part->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $part->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ old('description', $part->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty Stok</label>
                        <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty', $part->qty) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty Minimum</label>
                        <input type="number" class="form-control" id="qty_minimum" name="qty_minimum" value="{{ old('qty_minimum', $part->qty_minimum) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty Order</label>
                        <input type="number" class="form-control" id="qty_order" name="qty_order" value="{{ old('qty_order', $part->qty_order) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Part</button>
                    <a href="{{ route('parts.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
@endsection
