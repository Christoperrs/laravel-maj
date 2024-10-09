@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Parts List</div>
    <div class="card-body">
        @foreach ($products as $product)
            <h4>Parts for {{ $product->name }}</h4>
            @if ($product->parts->isEmpty())
                <p class="text-danger">Kosong, belum diisi. Perlu untuk diisi!</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->parts as $part)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $part->name }}</td>
                                    <td style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $part->description }}</td>
                                    <td>
                                        @can('edit-part')
                                            <a href="{{ route('products.parts.edit', [$product->id, $part->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                        
                                        @can('delete-part')
                                            <form action="{{ route('products.parts.destroy', [$product->id, $part->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this part?');">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @can('create-part')
                <a href="{{ route('products.parts.create', $product->id) }}" class="btn btn-success btn-sm my-2">Add New Part</a>
            @endcan
        @endforeach
    </div>
</div>
@endsection
