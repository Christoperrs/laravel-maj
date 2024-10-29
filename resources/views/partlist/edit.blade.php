@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Part</h1>

    <form action="{{ route('partlists.update', $partList) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="part">Part</label>
            <input type="text" name="part" class="form-control" value="{{ $partList->part }}" required>
        </div>

        <div class="form-group">
            <label for="no_series">No Series</label>
            <input type="text" name="no_series" class="form-control" value="{{ $partList->no_series }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
