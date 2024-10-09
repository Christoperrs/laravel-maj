@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Maintenance Part Details</h1>
    
    <div class="card mb-3">
        <div class="card-body">
            <h4>Product: {{ $maintenancePart->product->name }}</h4>
            <h5>Part: {{ $maintenancePart->part->name }}</h5>
            <p><strong>Kondisi:</strong> {{ $maintenancePart->condition }}</p>
            <p><strong>Waktu Pengecekan:</strong> {{ $maintenancePart->checked_at }}</p>
            <p><strong>Nama User:</strong> {{ $maintenancePart->user->name }}</p>
            @if($maintenancePart->notes)
                <p><strong>Catatan:</strong> {{ $maintenancePart->notes }}</p>
            @else
                <p><strong>Catatan:</strong> Tidak ada catatan</p>
            @endif
        </div>
    </div>
    
    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
