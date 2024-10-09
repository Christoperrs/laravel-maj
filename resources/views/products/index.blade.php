@extends('layouts.app')

@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Management Part Systems </h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
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
    <div class="card-header">Daftar Produk</div>
    <div class="card-body">
        @can('create-product')
            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Tambah Produk Baru</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Tampilkan</a>

                            @can('edit-product')
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-product')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda ingin menghapus produk ini?');"><i class="bi bi-trash"></i> Hapus</button>
                            @endcan
                            @can('view-part')
                                <a href="{{ route('products.parts.index', $product->id) }}" class="btn btn-info btn-sm">Manage Parts</a>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">
                        <span class="text-danger">
                            <strong>Produk Tidak Ditemukan!</strong>
                        </span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $products->links() }}

    </div>
</div>
@endsection
