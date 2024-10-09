@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Maintenance Part</h1>

    <form action="{{ route('maintenance.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="parts-container">
            <!-- Part list will be loaded here via JavaScript -->
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<script>
document.getElementById('product_id').addEventListener('change', function() {
    const productId = this.value;

    fetch(`/api/products/${productId}/parts`)
        .then(response => response.json())
        .then(parts => {
            let html = '';
            parts.forEach(part => {
                html += `
                    <div class="form-group">
                        <label>${part.name}</label>
                        <select name="condition[]" class="form-control">
                            <option value="Good">Good</option>
                            <option value="No Good">No Good</option>
                            <option value="Good After Repair">Good After Repair</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                        <input type="hidden" name="part[]" value="${part.id}">
                        <label for="note">Note (Optional)</label>
                        <input type="text" name="note[]" class="form-control">
                    </div>
                `;
            });
            document.getElementById('parts-container').innerHTML = html;
        });
});
</script>
@endsection
