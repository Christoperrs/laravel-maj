@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <h1 class="mb-4 text-center mt-3">Edit Penanggulangan Problem</h1>
        <hr>
        <div class="card shadow-sm border-0">
            <!-- <div class="card-header bg-primary text-white ml-3 mr-3">
                <h5 class="mb-0" style="color: white !important">Edit Problem Information</h5>
            </div> -->
            <div class="card-body">
                <form action="{{ route('repair.update', $problem->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Make sure this is included to support PUT request -->

                    <input type="hidden" name="Id_dies" value="{{ $problem->Id_dies }}">
                    
                    <!-- Display Product Information -->
                    <div class="mb-4">
                    <label class="form-label">Product Information</label>
                    <div class="alert alert-light">
                        <p class="mb-1"><strong>Part Number:</strong> {{ $problem->product->part_no ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Die Process:</strong> {{ $problem->product->process ?? 'N/A' }}</p>
                    </div>
                </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="shift_problem" class="form-label">Shift Problem/Sketch</label>
                            <textarea name="shift_problem" id="shift_problem" class="form-control" rows="4" required>{{ $problem->shift_problem }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="penanggulangan" class="form-label">Penanggulangan</label>
                            <textarea name="penanggulangan" id="penanggulangan" class="form-control" rows="4" required>{{ $problem->penanggulangan }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="item_penggantian" class="form-label">Item Penggantian (Part)</label>
                            <input type="hidden" name="id_before" id="id_before" class="form-control" value="{{  $problem->item_penggantian }}" required>
                            <select name="item_penggantian" id="item_penggantian" class="form-control" required>
                                <option value="" disabled {{ is_null($problem->part) ? 'selected' : '' }}>Pilih Part</option>
                                @foreach($parts as $part)
                                    <option value="{{ $part->id }}" {{ $problem->item_penggantian == $part->id ? 'selected' : '' }}>
                                        {{ $part->name }}-{{ $part->qty }} pcs
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="qty" class="form-label">Qty</label>
                            <input type="hidden" name="qty_before" id="qty_before" class="form-control" value="{{ $problem->qty }}" required>
                            <input type="number" name="qty" id="qty" class="form-control" value="{{ $problem->qty }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                    

                        <div class="col-md-6">
                            <label for="progres" class="form-label">Progres</label>
                            <input type="text" name="progres" id="progres" class="form-control" value="{{ $problem->progres ?? 'N/A' }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('repair.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Optional: Add a footer or additional information -->
<div class="text-center mt-4">
    <small class="text-muted">* Please ensure all fields are filled correctly.</small>
</div>
<style>
   
    .alert {
        border-radius: 10px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
</style>
@endsection
