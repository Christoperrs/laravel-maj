@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <h1 class="mb-4 text-center mt-3">Add New Dies</h1>
        <div class="text-center">
            <small class="text-muted"><span style="color:red">*</span> Please ensure all fields are filled correctly.</small>
        </div>

    <hr>
        <div class="card shadow-sm border-0">
            <!-- <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Product Information</h5>
            </div> -->
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label"><span style="color:red">*</span>Name</label>
                                <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Line -->
                            <div class="mb-3">
                                <label for="line" class="form-label"><span style="color:red">*</span>Line</label>
                                <input type="text" required class="form-control @error('line') is-invalid @enderror" id="line" name="line" value="{{ old('line') }}">
                                @error('line')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- No Job -->
                            <div class="mb-3">
                                <label for="no_job" class="form-label"><span style="color:red">*</span>No Job</label>
                                <input type="text" required class="form-control @error('no_job') is-invalid @enderror" id="no_job" name="no_job" value="{{ old('no_job') }}">
                                @error('no_job')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Part No -->
                            <div class="mb-3">
                                <label for="part_no" class="form-label"><span style="color:red">*</span>Part No</label>
                                <input type="text" required class="form-control @error('part_no') is-invalid @enderror" id="part_no" name="part_no" value="{{ old('part_no') }}">
                                @error('part_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Model -->
                            <div class="mb-3">
                                <label for="model" class="form-label"><span style="color:red">*</span>Model</label>
                                <input type="text" required class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}">
                                @error('model')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Process -->
                            <div class="mb-3">
                                <label for="process" class="form-label"><span style="color:red">*</span>Process</label>
                                <input type="text" required class="form-control @error('process') is-invalid @enderror" id="process" name="process" value="{{ old('process') }}">
                                @error('process')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Frequency of Production -->
                            <div class="mb-3">
                                <label for="frequency_production" class="form-label"><span style="color:red">*</span>Frequency of Production</label>
                                <input type="number" required class="form-control @error('frequency_production') is-invalid @enderror" id="frequency_production" name="frequency_production" value="{{ old('frequency_production') }}">
                                @error('frequency_production')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tension -->
                            <div class="mb-3">
                                <label for="tension" class="form-label"><span style="color:red">*</span>Tension</label>
                                <select required class="form-control @error('tension') is-invalid @enderror" id="tension" name="tension">
                                    <option value="">-- Select Tension --</option>
                                    <option value="UHT" {{ old('tension') == 'UHT' ? 'selected' : '' }}>UHT</option>
                                    <option value="Non UHT" {{ old('tension') == 'Non UHT' ? 'selected' : '' }}>Non UHT</option>
                                </select>
                                @error('tension')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Customer -->
                            <div class="mb-3">
                                <label for="customer" class="form-label"><span style="color:red">*</span>Customer</label>
                                <select required class="form-control @error('customer') is-invalid @enderror" id="customer" name="customer">
                                    <option value="">Select Customer</option>
                                    <option value="Hyundai" {{ old('customer') == 'Hyundai' ? 'selected' : '' }}>Hyundai</option>
                                    <option value="MMKI" {{ old('customer') == 'MMKI' ? 'selected' : '' }}>MMKI</option>
                                    <option value="ADM" {{ old('customer') == 'ADM' ? 'selected' : '' }}>ADM</option>
                                    <option value="SIM" {{ old('customer') == 'SIM' ? 'selected' : '' }}>SIM</option>
                                </select>
                                @error('customer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image upload -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 100%; height: 200px; margin-top: 10px;">
                            </div>
                        </div>
                    </div>

                    <!-- Table for parts -->
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <h5  class="text-center"><i class="fas fa-puzzle-piece"></i> Detail Item Part</h5>
                            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by item name..." onkeyup="filterTable()">
                            <div style="max-height: 300px; overflow-y: auto;"> <!-- Set max height and enable vertical scrolling -->
                                <table class="table" id="partsTable">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Item Part</th>
                                            <th>Qty used</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($parts as $part)
                                        <tr class="part-row">
                                            <td>
                                                <input type="checkbox" name="part_check[]" value="{{ $part->id }}" onchange="toggleQtyInput(this)">
                                            </td>
                                            <td>
                                                {{ $part->name }}
                                            </td>
                                            <td>
                                                <input type="number" name="qty[]" class="form-control" disabled>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h5  class="text-center mb-2"><i class="fas fa-images"></i> Detail Images</h5>
                        <button type="button" class="btn btn-primary" onclick="addImageRow()">Add Image</button>
                  
                        <table class="table table-border" id="imagesTable">
                            <thead>
                                <tr>
                                    <th>Upload Image (JPG, PNG, JPEG)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="file" name="detail_images[]" class="form-control" accept=".jpg, .jpeg, .png">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                       </div>
                    <!-- Submit button -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Add a footer or additional information -->

<style>
    .alert {
        border-radius: 10px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
</style>

<script>
    // Function to toggle the quantity input based on checkbox state
    function toggleQtyInput(checkbox) {
        const qtyInput = checkbox.closest('tr').querySelector('input[name="qty[]"]');
        qtyInput.disabled = !checkbox.checked; // Enable or disable based on checkbox state
        if (!checkbox.checked) {
            qtyInput.value = ""; // Reset value if unchecked
        }
    }

    // Function to filter the table based on search input
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('partsTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            const td = tr[i].getElementsByTagName('td')[1]; // Get the second column (Nama Item)
            if (td) {
                const txtValue = td.textContent || td.innerText;
                tr[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none"; // Show or hide based on search
            }
        }
    }
</script>
<script>
    let maxRows = 3; // Maximum number of rows

    function addImageRow() {
        const tableBody = document.querySelector('#imagesTable tbody');
        const rowCount = tableBody.rows.length;

        if (rowCount < maxRows) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <input type="file" name="detail_images[]" class="form-control" accept=".jpg, .jpeg, .png">
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeRow(this)">Delete</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        } else {
            alert('Maximum of 3 images can be uploaded.');
        }
    }

    function removeRow(button) {
        const row = button.closest('tr');
        row.remove();
    }
</script>
<script>
    function previewImage(event) {
        const image = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');

        // Display the image preview
        const reader = new FileReader();
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        if (image.files[0]) {
            reader.readAsDataURL(image.files[0]);
        } else {
            imagePreview.style.display = 'none';  // Hide if no file is selected
        }
    }
</script>
@endsection