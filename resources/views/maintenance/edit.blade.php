@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Maintenance Part</h1>

    <form action="{{ route('maintenance.update', $maintenancePart->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="product">Product</label>
            <input type="text" class="form-control" value="{{ $maintenancePart->product->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="part">Part</label>
            <input type="text" class="form-control" value="{{ $maintenancePart->part->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="condition">Condition</label>
            <select name="condition" class="form-control">
                <option value="Good" {{ $maintenancePart->condition == 'Good' ? 'selected' : '' }}>Good</option>
                <option value="No Good" {{ $maintenancePart->condition == 'No Good' ? 'selected' : '' }}>No Good</option>
                <option value="Good After Repair" {{ $maintenancePart->condition == 'Good After Repair' ? 'selected' : '' }}>Good After Repair</option>
                <option value="Tidak Ada" {{ $maintenancePart->condition == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Catatan (Opsional)</label>
            <textarea name="notes" class="form-control">{{ old('notes', $maintenancePart->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
