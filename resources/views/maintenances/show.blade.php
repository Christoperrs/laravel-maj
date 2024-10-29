@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Maintenance Details</h1>

    @if ($maintenance)
        <div class="card mb-3">
            <div class="card-header">
                <h5>Parts for {{ $maintenance->product->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Created At:</strong> {{ $maintenance->created_at }}</p>
                <p><strong>User:</strong> {{ $maintenance->user->name }}</p>
                <p><strong>Note:</strong> {{ $maintenance->note }}</p>
                <h5 class="mt-4">Maintenance Parts</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Part</th>
                            <th scope="col">Description</th>
                            <th scope="col">Condition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maintenance->maintenanceDetails->groupBy('part_id') as $partDetails)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="btn btn-warning">Edit Maintenance</a>
        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this maintenance?')">Delete Maintenance</button>
        </form>
        <a href="{{ route('maintenances.index') }}" class="btn btn-primary">Back to Maintenance List</a>
    @else
        <div class="alert alert-warning">No maintenance details found.</div>
    @endif
</div>
@endsection
