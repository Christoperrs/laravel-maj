@extends('layouts.app')

@section('content')
<div class="container">   
    <div class="card">
        <h1 class="mb-4 text-center mt-3">Create Request Stock</h1>
   
        <form action="{{ route('request.store') }}" method="POST" id="requestForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0" style="color: white !important">Request Details</h5>
                    </div>
                    <table class="table table-bordered" id="requestTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Item - Stock Available</th>
                                <th>Quantity order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <input type="text" class="form-control search-input me-2 mr-3" style="width: 50%;" placeholder="Search Item" onkeyup="filterFunction(this)">
                                        <select name="id_part[]" class="form-control part-select" required>
                                            <option value="">Select Item</option>
                                            @foreach($parts as $part)
                                                <option value="{{ $part->id }}">{{ $part->name }} - {{ $part->qty }} pcs</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="qty_order[]" min="0" class="form-control qty-order" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-row">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" id="addRow">Tambah Row</button>
                        <button type="submit" class="btn btn-success float-right">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function filterFunction(input) {
        const filter = input.value.toLowerCase();
        const select = input.nextElementSibling; // Get the next select element
        const options = select.options;

        for (let i = 1; i < options.length; i++) { // Start from 1 to skip the first option
            const txtValue = options[i].text.toLowerCase();
            options[i].style.display = txtValue.includes(filter) ? "" : "none"; // Show or hide options
        }
    }

    document.getElementById('addRow').addEventListener('click', function() {
        const tableBody = document.querySelector('#requestTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <div class="d-flex">
                    <input type="text" class="form-control search-input me-2 mr-3" style="width: 50%;" placeholder="Search Item" onkeyup="filterFunction(this)">
                    <select name="id_part[]" class="form-control part-select" required>
                        <option value="">Select Item</option>
                        @foreach($parts as $part)
                            <option value="{{ $part->id }}">{{ $part->name }} - {{ $part->qty }} pcs</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <input type="number" name="qty_order[]" class="form-control qty-order" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-row">Hapus</button>
            </td>
        `;
        tableBody.appendChild(newRow);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection