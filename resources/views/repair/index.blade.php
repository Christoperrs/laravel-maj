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

<div class="container">
    <div class="card shadow-sm">
        <!-- <div class="card-header bg-primary text-white">
            <h4 class="mb-0" style="color: white !important">List Penanggulangan Persetujuan</h4>
        </div> -->
        <div class="card-body">
            <h1 class="mb-4" >Penanggulangan Problem</h1>

            <!-- Input text for searching Product -->
            <div class="mb-3">
                <input type="text" id="productSearch" class="form-control" placeholder="Cari berdasarkan Dies (Product)">
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered " id="problemsTable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Part Number - Dies </th>
                            <th scope="col">Die Process </th>
                            <th scope="col">Penanggulangan</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Progres</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="problemsTableBody">
                        @foreach($repairs as $index => $problem)
                        <tr data-product-name="{{ strtolower($problem->product->name ?? 'N/A') }}" style="height: 60px;">
                            <td> <span class="badge badge-info">{{ $index + 1 }}</span></td>
                            <td>{{ $problem->product->part_no ?? 'N/A' }}-{{ $problem->product->name ?? 'N/A' }}</td>
                            <td>{{ $problem->product->process ?? 'N/A' }}</td>
                            <td>{{ $problem->penanggulangan }}</td>
                            <td>{{ $problem->user->name ?? 'N/A' }}</td>
                            <td>{{ $problem->progres ?? 'N/A' }}</td>
                            <td>
                                @switch($problem->status)
                                    @case(1)
                                        <span class="badge bg-danger text-white">Belum Approval</span>
                                        @break
                                    @case(2)
                                        <span class="badge bg-warning text-white">Disetujui Foreman</span>
                                        @break
                                    @case(3)
                                        <span class="badge bg-success text-white">Disetujui Section</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary text-white">Unknown Status</span>
                                @endswitch
                            </td>
                            <td>{{ $problem->updated_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('detail_repair', $problem->id) }}" class="btn btn-info btn-sm mr-3 mb-2">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                @switch($problem->status)
                                    @case(3)
                                    @break
                                    @default
                                    <a href="{{ route('repair.edit', $problem->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @endswitch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery for search functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        const rows = $('#problemsTableBody tr'); // All rows

        // Search functionality
        $('#productSearch').on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();
            rows.filter(function() {
                const productName = $(this).data('product-name');
                return productName.includes(searchValue);
            }).show();
            rows.filter(function() {
                const productName = $(this).data('product-name');
                return !productName.includes(searchValue);
            }).hide();
        });
    });
</script>

<!-- Custom Styles -->
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        vertical-align: middle; /* Center align content vertically */
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5; /* Light gray background on hover */
    }
    .badge {
        font-size: 0.9em; /* Slightly smaller badge font */
    }
</style>

@endsection