@extends('layouts.app')

@section('content')  
<h1>Maintenance Board</h1>

<div class="card">
    {{-- Tampilkan setiap Maintenance dalam kotak terpisah --}}
    <div class="card-body">
        <div class="row">
            @foreach ($maintenances->groupBy(function($maintenance) {
                return $maintenance->created_at->format('Y-m-d H:i:s'); // Group by created_at
            }) as $timestamp => $maintenanceGroup)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0">Maintenance on {{ $timestamp }}</h6>
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
                                                <td>{{ $partDetails->first()->part->name }}</td>
                                                <td>
                                                    @foreach (explode(',', $partDetails->first()->part->description) as $description)
                                                        {{ trim($description) }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($partDetails as $detail)
                                                        {{ $detail->condition }}<br>
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
@endsection
