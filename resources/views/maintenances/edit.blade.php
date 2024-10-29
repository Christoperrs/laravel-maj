@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Maintenance</h1>

        <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Pilihan Produk --}}
            <div class="form-group">
                <label for="product_id">Product</label>
                <select class="form-control" id="product_id" name="product_id">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $maintenance->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tampilkan Part dan Deskripsi dengan Kondisinya --}}
            <div class="form-group">
                <h5>Parts Checklist</h5>
                @foreach ($maintenance->maintenanceDetails->groupBy('part_id') as $partDetails)
                    <div class="card mb-2">
                        <div class="card-header">
                            {{ $partDetails->first()->part->name }}
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($partDetails as $detail)
                                    <li>
                                        <label>{{ $detail->description->description }}</label>
                                        <input type="text" name="conditions[{{ $detail->part->id }}][{{ $detail->description->id }}]" 
                                               value="{{ $detail->condition }}" class="form-control mb-2" placeholder="Condition">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Catatan --}}
            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control" id="note" name="note" rows="3">{{ $maintenance->note }}</textarea>
            </div>

            {{-- Tombol Simpan --}}
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
