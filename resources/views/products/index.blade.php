@extends('layouts.app')

@section('content')
<div class="container">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-header">
        <h2 class="pageheader-title">Management Part Systems</h2>
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">History Request</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Tooling Division</li> -->
                </ol>
            </nav>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card shadow-sm">
            
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">List of Dies Item</h1>
            @can('create-product')
                    <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2">
                        <i class="bi bi-plus-circle"></i> Tambah 
                    </a>
                @endcan
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan Nama...">
            </div>
            <!-- <div class="col-md-3">
                @can('create-product')
                    <a href="{{ route('products.create') }}" class="btn btn-success btn-sm ">
                        <i class="bi bi-plus-circle"></i> Tambah Produk Baru
                    </a>
                @endcan
            </div> -->
        </div>

            <!-- <div class="card-header bg-primary text-white">
                    <h4 class="mb-0" style="color: white !important" >Dies Item</h4>
            </div> -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Line</th>
                                <th scope="col">OP</th>
                                <th scope="col">QR Code</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            @forelse ($products as $product)
                            <tr>
                                <th scope="row"><span class="badge badge-info">{{ $loop->iteration }}</span></th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->part_no }}</td>
                                <td>{{ $product->line }}</td>
                                <td>{{ $product->process }}</td>
                                <td>
                                    @if($product->barcode)
                                        {!! QrCode::size(50)->generate(route('products.show', $product->id)) !!}
                                    @else
                                        <span>No QR Code Available</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-eye"></i> Tampilkan
                                    </a>
                                    @can('edit-product')
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    @endcan
                                    @can('delete-product')
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda ingin menghapus produk ini?');">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <span class="text-danger">
                                        <strong>Produk Tidak Ditemukan!</strong>
                                    </span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $products->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
</div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase(); // Get the search input value and convert to lowercase
        const tableRows = document.querySelectorAll('#productTableBody tr'); // Get all table rows

        tableRows.forEach(row => {
            const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Get the Product Name column for each row
            if (productName.includes(searchValue)) {
                row.style.display = ''; // Show the row if the product name matches the search input
            } else {
                row.style.display = 'none'; // Hide the row if it doesn't match
            }
        });
    });
</script>
@endsection