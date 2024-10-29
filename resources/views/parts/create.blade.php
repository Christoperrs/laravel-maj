@extends('layouts.app')

@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="card">
            <div class="card-header">Tambah Bagian Baru</div>
            <div class="card-body">
                <form id="partsForm" action="{{ route('parts.store') }}" method="POST">
                    @csrf
                    <table class="table" id="partsTable">
                        <thead>
                            <tr>
                                <th>Nama Item</th>
                                <th>Deskripsi</th>
                                <th>Qty Stok</th>
                                <th>Qty Minimum</th>
                                <th>Qty Order</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="part-row">
                                <td>
                                    <input type="text" class="form-control" name="name[]" required>
                                </td>
                                <td>
                                    <div>
                                        <textarea class="form-control" name="description[0][0]" required></textarea>
                                        <textarea class="form-control mt-1" name="description[0][1]"></textarea>
                                        <textarea class="form-control mt-1" name="description[0][2]"></textarea>
                                        <textarea class="form-control mt-1" name="description[0][3]"></textarea>
                                        <textarea class="form-control mt-1" name="description[0][4]"></textarea>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="qty[]" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="qty_minimum[]" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="qty_order[]" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-part">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <button type="button" class="btn btn-success mt-3" id="addPart">Tambah Part</button> -->
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menambahkan part baru
        document.getElementById('addPart').addEventListener('click', function () {
            const tableBody = document.querySelector('#partsTable tbody');
            const partCount = tableBody.children.length; // Hitung jumlah part yang ada
            const newRow = document.createElement('tr');
            newRow.classList.add('part-row');
            newRow.innerHTML = `
                <td>
                    <input type="text" class="form-control" name="name[]" required>
                </td>
                <td>
                    <div>
                        <textarea class="form-control" name="description[${partCount}][0]" required></textarea>
                        <textarea class="form-control mt-1" name="description[${partCount}][1]"></textarea>
                        <textarea class="form-control mt-1" name="description[${partCount}][2]"></textarea>
                        <textarea class="form-control mt-1" name="description[${partCount}][3]"></textarea>
                        <textarea class="form-control mt-1" name="description[${partCount}][4]"></textarea>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control" name="qty[]" required>
                </td>
                 <td>
                    <input type="number" class="form-control" name="qty_minimum[]" required>
                </td>
                 <td>
                    <input type="number" class="form-control" name="qty_order[]" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-part">Hapus</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        });

        // Menghapus part
        document.querySelector('#partsTable tbody').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-part')) {
                e.target.closest('tr').remove(); 
            }
        });
    });
</script>
@endsection
