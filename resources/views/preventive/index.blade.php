@extends('layouts.app')

@section('content')
<style>
    .status-box {
        display: inline-block;
        width: 80px;
        height: 30px;
        border-radius: 5px;
        color: white;
        text-align: center;
        line-height: 30px;
    }
    .status-running {
        background-color: green;
    }
    .status-stop {
        background-color: gray;
    }
    .status-not-started {
        background-color: orange; /* Menambah warna untuk NOT STARTED */
    }
</style>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-header">
        <h2 class="pageheader-title">Preventive Count Stroke System</h2>
        <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">New Armada</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tooling Division</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Preventive Count Stroke System</h3>
        <a href="{{ route('preventive.dark') }}" class="btn btn-primary float-right">🔍 Perbesar</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">No Produk</th>
                    <th scope="col">Process</th>
                    <th scope="col">Machine</th>
                    <th scope="col" class="text-center">Interval</th>
                    <th scope="col" class="text-center">Current Stroke</th>
                    <th scope="col" class="text-center">Limit Stroke</th>
                    <th scope="col" class="text-center">% Stroke</th>
                    <th scope="col" class="text-center">Accumulative Stroke</th>
                    <th scope="col" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productsWithProcesses as $index => $process)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $process['product_name'] }}</td>
                    <td>{{ $process['part_no'] }}</td>
                    <td>{{ $process['process'] }}</td>
                    <td>{{ $process['machine'] }}</td>
                    <td class="text-center">{{ $process['interval'] }}</td>
                    <td class="text-center">{{ $process['current_stroke'] }}</td>
                    <td class="text-center">{{ $process['limit_stroke'] }}</td>
                    <td class="text-center">{{ round(($process['current_stroke'] / $process['limit_stroke']) * 100, 2) }}%</td>
                    <td class="text-center">{{ $process['accumulative_stroke'] }}</td>
                    <td class="text-center">
                        <div class="status-box
                            {{ $process['status'] == '-' ? 'status-not-started' :
                               ($process['status'] == 'RUNNING' ? 'status-running' : 'status-stop') }}">
                            {{ $process['status'] == '-' ? 'NOT STARTED' :
                               ($process['status'] == 'RUNNING' ? 'RUNNING' : 'STOP') }}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        function fetchCurrentStrokeData() {
            console.log("Fetching data...");
            $.ajax({
                url: '/preventive/current-stroke',
                method: 'GET',
                success: function(data) {
                    console.log("Data fetched successfully:", data);
                    $('tbody').empty();
                    $.each(data, function(index, process) {
                        $('tbody').append(
                            `<tr>
                                <td class="text-center">${index + 1}</td>
                                <td>${process.product_name}</td>
                                <td>${process.part_no}</td>
                                <td>${process.process}</td>
                                <td>${process.machine}</td>
                                <td class="text-center">${process.interval}</td>
                                <td class="text-center">${process.current_stroke}</td>
                                <td class="text-center">${process.limit_stroke}</td>
                                <td class="text-center">${(process.current_stroke / process.limit_stroke * 100).toFixed(2)}%</td>
                                <td class="text-center">${process.accumulative_stroke}</td>
                                <td class="text-center">
                                    <div class="status-box
                                        ${process.status == '-' ? 'status-not-started' :
                                        (process.status == 'RUNNING' ? 'status-running' : 'status-stop')}">
                                        ${process.status == '-' ? 'NOT STARTED' :
                                        (process.status == 'RUNNING' ? 'RUNNING' : 'STOP')}
                                    </div>
                                </td>
                            </tr>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            });
        }

        fetchCurrentStrokeData();
        setInterval(fetchCurrentStrokeData, 30000);
    });
</script>
@endsection
