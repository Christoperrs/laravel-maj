@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h1 class="mt-3 text-center">Penanggulangan Problem</h1>
        <div class="text-center">
                <small class="text-muted"><span style="color:red">*</span> Please ensure all fields are filled correctly.</small>
        </div>
        <hr>
        
        <form action="{{ route('repair.store') }}" method="POST" class=" p-4 rounded shadow-sm">
            @csrf
            <input type="hidden" name="Id_dies" value="{{ $id_dies }}">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="problemTable">
                    <thead class="table-light">
                        <tr>
                            <th>Shift Problem/Sketch</th>
                            <th>Penanggulangan</th>
                            <th>Item Penggantian</th>
                            <th>Qty</th>
                            <th>Progres</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="noRowsMessage">
                            <td colspan="7" class="text-center">Tidak ada baris yang tersedia</td>
                        </tr>
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="button" id="addRowBtn" class="btn btn-primary">Tambah Row</button>
                <button type="submit" class="btn btn-success">Simpan Data</button>
                <a href="{{ route('maintenances.create', ['product' => $id_dies]) }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
<style>
    .form-control {
        border-radius: 15px;
    }
    .mt-3 {
        margin-top: 20px !important;
    }
    .search-input {
        width: 100%;
        margin-bottom: 10px;
    }
</style>

<script>
    document.getElementById('addRowBtn').addEventListener('click', function() {
        let partsOptions = '';

        @foreach($parts as $part)
            partsOptions += `<option value="{{ $part->id }}">{{ $part->name }}-{{ $part->qty }}</option>`;
        @endforeach

        const row = `
            <tr>
                <td><textarea name="shift_problem[]" class="form-control" rows="3" required></textarea></td>
                <td><textarea name="penanggulangan[]" class="form-control" rows="3" required></textarea></td>
                <td>
                    <!-- Searchable dropdown with search input -->
                    <input type="text" class="form-control search-input" placeholder="Search Item..." oninput="filterOptions(this)">
                    <select name="item_penggantian[]" class="form-control" required>
                        <option value="">Pilih Item</option>
                        ${partsOptions}
                    </select>
                </td>
                <td><input type="number" name="qty[]" class="form-control" min="1" required></td>
                <td><input type="text" name="progres[]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger deleteRowBtn">Delete</button></td>
            </tr>
        `;
        const noRowsMessage = document.getElementById('noRowsMessage');
        if (noRowsMessage) {
            noRowsMessage.remove();
        }

        document.querySelector('#problemTable tbody').insertAdjacentHTML('beforeend', row);

        document.querySelectorAll('.deleteRowBtn').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
                checkEmptyTable();
            });
        });
    });
    function filterOptions(input) {
        const filter = input.value.toLowerCase();
        const select = input.nextElementSibling;
        const options = select.querySelectorAll('option');

        options.forEach(option => {
            if (option.value && option.text.toLowerCase().includes(filter)) {
                option.style.display = '';
            } else if (option.value) {
                option.style.display = 'none';
            }
        });
    }
    function checkEmptyTable() {
        const tbody = document.querySelector('#problemTable tbody');
        if (!tbody.querySelector('tr')) {
            tbody.innerHTML = `<tr id="noRowsMessage"><td colspan="7" class="text-center">Tidak ada baris yang tersedia</td></tr>`;
        }
    }
</script>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        let valid = true; 
        let errorMessage = ''; 

        const rows = document.querySelectorAll('#problemTable tbody tr');
        rows.forEach(row => {
            const itemSelect = row.querySelector('select[name="item_penggantian[]"]');
            const qtyInput = row.querySelector('input[name="qty[]"]');
            const selectedItemId = itemSelect.value;
            const enteredQty = parseInt(qtyInput.value, 10);

            @foreach($parts as $part)
            if (selectedItemId == '{{ $part->id }}') {
                const maxQty = {{ $part->qty }}; 

                if (enteredQty > maxQty) {
                    valid = false;
                    errorMessage += `QTY pengambilan untuk item "${{{ $part->name }}}" harus lebih kecil dari stok (${maxQty})!\n`;
                }
            }
            @endforeach
        });

        if (!valid) {
            event.preventDefault();
            alert(errorMessage);
        }
    });
</script>

@endsection
