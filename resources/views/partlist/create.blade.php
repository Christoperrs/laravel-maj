@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Part</h1>

    <form action="{{ route('partlists.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="part">Part</label>
            <input type="text" name="part" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="no_series">No Series</label>
            <input type="text" name="no_series" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
