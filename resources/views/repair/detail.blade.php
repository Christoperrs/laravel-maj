@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detail Penanggulangan Problem</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Problem Information</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Dies (Product)</th>
                    <td>{{ $problem->product->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Die Process (Description)</th>
                    <td>{{ $problem->product->description ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Shift Problem/Sketch</th>
                    <td>{{ $problem->shift_problem }}</td>
                </tr>
                <tr>
                    <th>Penanggulangan</th>
                    <td>{{ $problem->penanggulangan }}</td>
                </tr>
                <tr>
                    <th>Item Penggantian (Part)</th>
                    <td>{{ $problem->part->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Qty</th>
                    <td>{{ $problem->qty }}</td>
                </tr>
                <tr>
                    <th>PIC</th>
                    <td>{{ $problem->pic }}</td>
                </tr>
                <tr>
                    <th>Progres</th>
                    <td>{{ $problem->progres ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Approved Foreman</th>
                    <td>{{ $problem->foreman->name ?? '-'}}</td>
                </tr>
                <tr>
                    <th>Approved Section</th>
                    <td>{{ $problem->section->name?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        @if($problem->status != 3)
            <button type="button" class="btn btn-success" style="margin-right: 20px;" onclick="submitForm('{{ $problem->status }}')">Approve</button>
        @endif
         <a href="{{ route('repair.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<script>
function submitForm(actionType) {
    let form = document.createElement('form');
    form.method = 'POST';
    let actionUrl = '';

    // Define the correct action URL based on the status
    if (actionType == 1) {
        actionUrl = "{{ route('repair.approveForeman', $problem->id) }}";
    } else if (actionType == 2) {
        actionUrl = "{{ route('repair.approveSection', $problem->id) }}";
    }

    form.action = actionUrl;

    // Add the CSRF token and method fields
    form.innerHTML = `@csrf @method('PUT') <input type="hidden" name="action" value="${actionType == 1 ? 2 : 3}">`;

    document.body.appendChild(form);
    form.submit();
}
</script>

<!-- Bootstrap JS (required for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
