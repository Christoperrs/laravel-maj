@extends('layouts.app')

@section('content')
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
<div class="container">
    <!-- Header -->
    <div class="card">
        <!-- <div class="card-header">Request Stock List</div> -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Request Stock List</h1>
                    <a href="{{ route('request.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan Part Name...">
                </div>
            <!-- Table inside a card -->
                <div class="card shadow-sm">
                    <!-- <div class="card-header bg-primary text-white">
                        <h4 class="mb-0" style="color: white !important" >List of Requested Stocks</h4>
                    </div> -->
                    <div class="card-body p-0">
                        <form action="{{ route('request.update') }}" method="POST" id="bulkCancelForm">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th> <!-- Checkbox to select all -->
                                            <th>No</th>
                                            <th>Item Part</th>
                                            <th>Quantity Ordered</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody  id="requestStockTableBody">
                                        @foreach($requestStocks as $requestStock)
                                        <tr>
                                            <td><input type="checkbox" name="request_ids[]" value="{{ $requestStock->id }}"></td> <!-- Checkbox for each order -->
                                            <td><span class="badge badge-info">{{ $requestStock->id }}</span></td>
                                            <td>{{ $requestStock->part->name }}</td>
                                            <td>
                                                <span class="badge badge-secondary">{{ $requestStock->qty_order }} pcs</span>
                                            </td>
                                            <td>
                                                {{ $requestStock->status == 1 ? 'Terkirim' : 'Dibatalkan' }} <!-- Conditional status display -->
                                            </td>
                                            <td>{{ $requestStock->created_at->format('d M Y, H:i') }}</td>
                                        
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-danger mt-3 mb-2 ml-3"  id="bulkCancelButton" disabled>Batalkan Order</button> <!-- Single button for bulk cancel -->
                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <!-- Pagination -->
                        <div>
                            <!-- Pagination controls can go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="request_ids[]"]');
        const bulkCancelButton = document.getElementById('bulkCancelButton');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        bulkCancelButton.disabled = !this.checked;
    });

    // Enable/disable the cancel button based on individual checkbox selections
    const checkboxes = document.querySelectorAll('input[name="request_ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const bulkCancelButton = document.getElementById('bulkCancelButton');
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            bulkCancelButton.disabled = !anyChecked;
        });
    });
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase(); // Get the search input value and convert to lowercase
        const tableRows = document.querySelectorAll('#requestStockTableBody tr'); // Get all table rows

        tableRows.forEach(row => {
            const partName = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Get the Part Name column for each row
            if (partName.includes(searchValue)) {
                row.style.display = ''; // Show the row if the part name matches the search input
            } else {
                row.style.display = 'none'; // Hide the row if it doesn't match
            }
        });
    });
</script>
@endsection