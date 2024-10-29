@extends('layouts.app')

@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Management Part Systems</h2>
                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque tortor lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">New Armada</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tooling Division</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Item Parts</div>
            <div class="card-body">
    
                @can('create-part')
                    <a href="{{ route('parts.create') }}" class="btn btn-success btn-sm my-2">Add New Part</a>
                @endcan
                <div class="mb-4 p-3 bg-light border rounded">
                    <h5>Catatan/Keterangan:</h5>
                    <ul>
                        <li><strong>Qty Stok:</strong> Jumlah stok item part yang berada di gudang.</li>
                        <li><strong>Qty Minimum:</strong> Jumlah minimum item part yang wajib ada di gudang.</li>
                        <li><strong>Qty Order:</strong> Jumlah pemesanan item part yang akan dikirimkan ke pihak purchasing.</li>
                        <br>
                        <span style="color:red">* </span>Apabila item part tidak memerlukan stok, silahkan kosongi kolom diatas</li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Spesifikasi</th>
                                <th>Qty</th>
                                <th>Qty Minimum</th>
                                <th>Qty Order</th>
                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parts as $part)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $part->name }}</td>
                                    <td>
                                        <ul>
                                            @php
                                                // Misalkan deskripsi dipisahkan oleh koma
                                                $descriptions = explode(',', $part->description);
                                            @endphp
                                            @foreach ($descriptions as $description)
                                                <li>{{ trim($description) }}</li> <!-- trim() untuk menghapus spasi -->
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $part->qty }}</td>
                                    <td>{{ $part->qty_minimum }}</td>
                                    <td>{{ $part->qty_order }}</td>
                                  
                                    <td>
                                        @can('edit-part')
                                            <a href="{{ route('parts.edit', $part->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan

                                        @can('delete-part')
                                            <form action="{{ route('parts.destroy', $part->id) }}" method="POST" style="display:inline;">
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
              
            </div>
        </div>
    
@endsection 
