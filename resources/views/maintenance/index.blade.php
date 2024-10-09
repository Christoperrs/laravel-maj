@extends('layouts.app')

@section('content')
<a href="{{ route('maintenance.create') }}" class="btn btn-success btn-sm my-4">Add Maintenance</a>

@foreach($maintenanceParts->groupBy('product.name') as $productName => $productMaintenanceParts)
    <div class="card mb-4">
        <div class="card-header h4 text-dark">{{ $productName }}</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Part</th>
                        <th>Standart</th>
                        <th class="text-center">Condition</th>
                        <th>Checked At</th>
                        <th>User</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productMaintenanceParts as $maintenancePart)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $maintenancePart->part->name }}</td>
                            <td>{{ $maintenancePart->part->description ?? 'No description' }}</td>
                            <td class="text-center">
                                @if($maintenancePart->condition == 'Good')
                                    <i class="far fa-circle text-success"></i>
                                @elseif($maintenancePart->condition == 'No Good')
                                    <i class="fas fa-times text-danger"></i>
                                @elseif($maintenancePart->condition == 'Good After Repair')
                                    <i class="far fa-times-circle"></i>
                                @elseif($maintenancePart->condition == 'Tidak Ada')
                                    <i class="fas fa-window-minimize"></i>
                                @else
                                    {{ $maintenancePart->condition }}
                                @endif
                            </td>
                            <td>{{ $maintenancePart->checked_at }}</td>
                            <td>{{ $maintenancePart->user->name }}</td>
                            <td>{{ $maintenancePart->notes ?? 'No notes' }}</td>
                            <td>
                                <a href="{{ route('maintenance.show', $maintenancePart->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                
                                @can('edit-maintenance')
                                    <a href="{{ route('maintenance.edit', $maintenancePart->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                @endcan

                                @can('delete-maintenance')
                                    <form action="{{ route('maintenance.destroy', $maintenancePart->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach

@endsection
