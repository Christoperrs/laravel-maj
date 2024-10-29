@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-center ">
            <h1 class="mb-0"    >Dies Details</h1>
            <!-- <small class="text-muted"><span style="color:red">*</span> Please ensure all information is accurate.</small> -->
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5><i class="fas fa-tag"></i> Name</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->name }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-cogs"></i> Line</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->line }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-briefcase"></i> No Job</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->no_job }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-list-alt"></i> Part No</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->part_no }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-cube"></i> Model</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->model }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-process"></i> Process</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->process }}</strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <h5><i class="fas fa-calendar-check"></i> Frequency of Production</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->frequency_production }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-bolt"></i> Tension</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->tension }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-user"></i> Customer</h5>
                        <div class="border p-2 rounded bg-light">
                            <strong>{{ $product->customer }}</strong>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-image"></i> Product Image</h5>
                        <div class="border p-2 rounded bg-light text-center">
                            @if($product->image)
                                @php
                                    // Path to the image
                                    $imagePath = storage_path('app/public/' . $product->image);
                                    // Check if the file exists and encode it in Base64
                                    $base64Image = null;

                                    if (file_exists($imagePath)) {
                                        $imageData = base64_encode(file_get_contents($imagePath));
                                        $base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
                                    }
                                @endphp
                                @if($base64Image)
                                    <img src="{{ $base64Image }}" alt="Product Image" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                                @else
                                    <p>No image available</p>
                                @endif
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-qrcode"></i> QR Code</h5>
                        <div class="border p-2 rounded bg-light text-center">
                            {!! QrCode::size(150)->generate(route('products.show', $product->id)) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5><i class="fas fa-image"></i> Main Image</h5>
                        <div class="border p-2 rounded bg-light text-center">
                            @if($product->detailPictures->isNotEmpty())
                                @php
                                    // Get the first image as the main image
                                    $mainImagePath = storage_path('app/public/' . $product->detailPictures->first()->path_gambar);
                                    $base64MainImage = null;

                                    if (file_exists($mainImagePath)) {
                                        $mainImageData = base64_encode(file_get_contents($mainImagePath));
                                        $base64MainImage = 'data:image/' . pathinfo($mainImagePath, PATHINFO_EXTENSION) . ';base64,' . $mainImageData;
                                    }
                                @endphp
                                @if($base64MainImage)
                                    <img id="mainImage" src="{{ $base64MainImage }}" alt="Main Image" class="img-fluid" style="max-width: 100%; max-height: 300px;">
                                @else
                                    <p>No image available</p>
                                @endif
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5><i class="fas fa-images"></i> Image Gallery</h5>
                    <div class="row">
                        @foreach($product->detailPictures as $picture)
                            @php
                                // Path to the thumbnail image
                                $thumbnailPath = storage_path('app/public/' . $picture->path_gambar);
                                $base64Thumbnail = null;

                                if (file_exists($thumbnailPath)) {
                                    $thumbnailData = base64_encode(file_get_contents($thumbnailPath));
                                    $base64Thumbnail = 'data:image/' . pathinfo($thumbnailPath, PATHINFO_EXTENSION) . ';base64,' . $thumbnailData;
                                }
                            @endphp
                            <div class="col-4 mb-2">
                                @if($base64Thumbnail)
                                    <img src="{{ $base64Thumbnail }}" alt="Thumbnail" class="img-fluid thumbnail" style="cursor: pointer;" onclick="changeMainImage('{{ $base64Thumbnail }}')">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Part listing -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 class="text-center"><i class="fas fa-puzzle-piece"></i> Parts</h5>
                    @if($product->parts->isNotEmpty())
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="color: white !important">Item Part</th>
                                    <th style="color: white !important">Standart</th>
                                    <th style="color: white !important">Total Items Used</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->parts as $part)
                                    <tr>
                                        <td>{{ $part->name }}</td>
                                        <td>
                                            <ul>
                                                @php
                                                    // Misalkan deskripsi dipisahkan oleh koma
                                                    $descriptions = explode(',', $part->description);
                                                @endphp
                                                @foreach ($descriptions as $description)
                                                    <li>{{ trim($description) }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $part->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">No parts associated with this product.</p>
                    @endif
                </div>
            </div>
            <h5 class="mt-4"><i class="fas fa-exclamation-triangle"></i> History Problems</h5>
            @if($problems->isNotEmpty())
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th style="color: white">ID</th>
                            <th style="color: white">Shift Problem</th>
                            <th style="color: white">Penanggulangan</th>
                            <th style="color: white">Status</th>
                            <th style="color: white">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($problems as $problem)
                            <tr>
                                <td>{{ $problem->id }}</td>
                                <td>{{ $problem->shift_problem }}</td>
                                <td>{{ $problem->penanggulangan }}</td>
                                <td>{{ $problem->status }}</td>
                                <td>{{ $problem->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No problems associated with this product.</p>
            @endif

            <!-- History Maintenance Table -->
            <h5 class="mt-4"><i class="fas fa-wrench"></i> History Maintenance</h5>
            @if($maintenances->isNotEmpty())
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th style="color: white">ID</th>
                            <th style="color: white">Note</th>
                            <th style="color: white" >Approval Status</th>
                            <th style="color: white">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($maintenances as $maintenance)
                            <tr>
                                <td>{{ $maintenance->id }}</td>
                                <td>{{ $maintenance->note }}</td>
                                <td>{{ $maintenance->approval_status }}</td>
                                <td>{{ $maintenance->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No maintenance records associated with this product.</p>
            @endif
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>

<script>
    function changeMainImage(imageSrc) {
        document.getElementById('mainImage').src = imageSrc; // Change the main image source
    }
</script>

@endsection