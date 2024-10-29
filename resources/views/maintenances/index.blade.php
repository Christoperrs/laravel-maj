@extends('layouts.app')

@section('content')
<h1>Maintenance List</h1>
<div class="card">

    {{-- Dropdown untuk memilih produk --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button tabindex="-1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Select Product
            </button>
            <div class="dropdown-menu">
                @foreach ($products as $product)
                    <a class="dropdown-item" href="{{ route('maintenances.index', ['product' => $product->id]) }}">
                        {{ $product->part_no }} - OP {{ $product->process }}
                    </a>
                @endforeach
            </div>
        </div>
        <input type="text" class="form-control" placeholder="Selected Product" aria-label="Selected Product" readonly>
    </div>
</div>

@if (isset($selectedProduct))
    {{-- Tampilkan setiap Maintenance dalam kotak terpisah --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Parts for {{ $selectedProduct->name }}</h5>
            <a href="{{ route('maintenances.create', ['product' => $selectedProduct->id]) }}" class="btn btn-success">Create Maintenance</a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($maintenances->groupBy(function($maintenance) {
                    return $maintenance->created_at->format('Y-m-d H:i:s'); // Group by created_at
                }) as $timestamp => $maintenanceGroup)
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0">Maintenance on {{ $timestamp }}</h6>
                                <form action="{{ route('maintenances.approve', ['maintenance' => $maintenanceGroup->first()->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <select name="approval" class="form-control" style="display:inline; width:auto;">
                                        <option value="">Select Action</option>
                                        <option value="approved">Approved</option>
                                        <option value="no approve">No Approve</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                                </form>
                                {{-- Display approval status --}}
                                @if ($maintenanceGroup->first()->approval_status === 'approved')
                                    @php
                                        // Ambil nama pengguna yang meng-approve
                                        $approvedByUser = \App\Models\User::find($maintenanceGroup->first()->approved_by);
                                    @endphp
                                    <span class="badge badge-success">Approved by {{ $approvedByUser ? $approvedByUser->name : 'Unknown User' }}</span>
                                @else
                                    <span class="badge badge-danger">Not Approved</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Part</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Condition</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Note</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenanceGroup as $maintenance)
                                            @foreach ($maintenance->maintenanceDetails->groupBy('part_id') as $partDetails)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $maintenance->product->name }}</td>
                                                    <td>{{ $partDetails->first()->part->name }}</td> <!-- Tampilkan nama part -->
                                                    <td>
                                                        @foreach (explode(',', $partDetails->first()->part->description) as $description)
                                                            {{ trim($description) }}<br> <!-- Tampilkan deskripsi -->
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($partDetails as $detail)
                                                            {{ $detail->condition }}<br> <!-- Tampilkan kondisi -->
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $maintenance->user->name }}</td>
                                                    <td>{{ $maintenance->note }}</td>
                                                    <td>
                                                        <a href="{{ route('maintenances.show', $maintenance->id) }}" class="btn btn-sm btn-primary">Show</a>
                                                        <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this maintenance?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection
