@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-header mb-0">Add Maintenance</h5>
        <button id="penanggulanganProblemBtn" class="btn btn-warning mr-3">
            <i class="fas fa-exclamation-triangle"></i> Penanggulangan Problem
        </button>
    </div>
        <div class="card-body">
            <form id="maintenanceForm" action="{{ route('maintenances.store') }}" method="POST">
                @csrf

                <!-- Product Selection -->
                <div class="form-group">
                    <label for="product">Product</label>
                    <select class="form-control @error('product_id') is-invalid @enderror" id="product" name="product_id" required>
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    </select>
                    @error('product_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Parts and Conditions -->
                @if($parts->isNotEmpty())
                    @foreach ($parts as $detailPart)
                        <h3 class="mt-4">{{ $detailPart->part->name ?? 'Part name not found' }}</h3>
                        @foreach (explode(',', $detailPart->part->description ?? '') as $description)
                            <p>{{ trim($description) }}</p>

                            <div class="form-group">
                                <label>Condition</label>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="conditions[{{ $detailPart->part->id }}][]" value="Good"> 
                                    <label class="form-check-label" for="condition">Good</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="conditions[{{ $detailPart->part->id }}][]" value="No Good"> 
                                    <label class="form-check-label" for="condition">No Good</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="conditions[{{ $detailPart->part->id }}][]" value="Good After Repair"> 
                                    <label class="form-check-label" for="condition">Good After Repair</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="conditions[{{ $detailPart->part->id }}][]" value="Tidak Ada"> 
                                    <label class="form-check-label" for="condition">Tidak Ada</label>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @else
                    <p>Parts not found.</p>
                @endif

                <!-- Note -->
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3"></textarea>
                    @error('note')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between mt-4">
                   <button type="submit" class="btn btn-primary">Submit</button>
                   <a href="{{ route('products.index') }}" class="btn btn-secondary" id="kembaliBtn">Kembali</a>
               
                </div>
                  </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('maintenanceForm');
    const productSelect = document.getElementById('product');
    
    // Restore data from localStorage
    const savedData = JSON.parse(localStorage.getItem('maintenanceData'));
    if (savedData) {
        // Set product ID
        if (savedData.product_id) {
            productSelect.value = savedData.product_id[0]; // Assuming one value for product
        }

        // Restore note field
        if (savedData.note) {
            document.getElementById('note').value = savedData.note[0];
        }

        // Restore conditions for parts
        Object.keys(savedData).forEach(key => {
            if (key.startsWith('conditions')) {
                // Extract the part ID from the key (e.g., "conditions[1]" -> 1)
                const partId = key.match(/\d+/)[0];
                const conditions = savedData[key];

                // Select the corresponding checkboxes for each condition
                conditions.forEach(condition => {
                    const checkbox = document.querySelector(`input[name="conditions[${partId}][]"][value="${condition}"]`);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }
        });
    }

    // Save form data to localStorage on "Penanggulangan Problem" button click
    document.getElementById('penanggulanganProblemBtn').addEventListener('click', function() {
        const formData = new FormData(form);
        const data = {};

        // Gather form data into an object
        formData.forEach((value, key) => {
            if (!data[key]) {
                data[key] = [];
            }
            data[key].push(value);
        });

        // Save the data into localStorage
        localStorage.setItem('maintenanceData', JSON.stringify(data));

        // Check if product is selected
        const productId = productSelect.value;
        if (productId) {
            window.location.href = `{{ route('repair.create') }}?id_dies=${productId}`;
        } else {
            alert('Please select a product before proceeding to Penanggulangan Problem.');
        }
    });

    // Clear localStorage on form submission
    form.addEventListener('submit', function() {
        localStorage.removeItem('maintenanceData');
    });
    document.getElementById('kembaliBtn').addEventListener('click', function() {
        localStorage.removeItem('maintenanceData');
    });
});

</script>
@endsection
