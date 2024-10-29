

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tooling Digital</title>

    <!-- Required meta tags -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <title>@yield('title', 'Dashboard')</title>

    <style>
        html, body {
            height: 100%;
            font-family: 'Bahnschrift', sans-serif; /* Mengubah font menjadi Bahnschrift */
            font-weight: bold; /* Membuat teks menjadi tebal (bold) */
        }

        .dashboard-main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Bahnschrift', sans-serif;
            font-weight: bold;
        }

        .dashboard-wrapper {
            flex: 1;
            margin-left: 250px;
            font-family: 'Bahnschrift', sans-serif;
            font-weight: bold;
        }

        .footer {
            background-color: #fff;
            padding: 10px 20px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 10;
            font-family: 'Bahnschrift', sans-serif;
            font-weight: bold;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .logo img {
            height: 50px; /* Sesuaikan tinggi logo */
        }

        .title {
            flex: 1;
            text-align: center;
        }

        .time {
            white-space: nowrap;
        }

        .table-dark, .table-dark th, .table-dark td {
            font-family: 'Bahnschrift', sans-serif;
            font-weight: bold;
        }

        .status-box {
            font-family: 'Bahnschrift', sans-serif;
            font-weight: bold;
        }

        /* Styles for dark table */
        .table-dark {
            background-color: #353636; /* Dark background */
            color: white; /* White text */
        }

        .table-dark th, .table-dark td {
            border-color: #000000; /* Darker borders */
        }

        .table-dark th {
            background-color: #000000; /* Darker header background */
        }

        thead th {
            background-color: black !important; /* Pastikan latar belakang hitam */
            color: white !important; /* Pastikan teks berwarna putih */
            text-transform: uppercase; /* Mengubah teks menjadi huruf kapital */
            border: 1px solid #ccc; /* Border abu-abu (opsional) */
        }
    </style>

</head>
<body>
    <style>
        .status-box {
            display: inline-block;
            width: 80px; /* Adjust width as needed */
            height: 30px; /* Adjust height as needed */
            border-radius: 5px; /* Rounded corners */
            color: white; /* Text color */
            text-align: center; /* Center text */
            line-height: 30px; /* Center text vertically */
        }
        .status-running {
            background-color: green; /* Green for RUNNING */
        }
        .status-stop {
            background-color: rgb(241, 46, 46); /* Gray for STOP */
        }
        /* New styles for dark table */
        .table-dark {
            background-color: #353636; /* Dark background */
            color: white; /* White text */
        }
        .table-dark th, .table-dark td {
            border-color: #000000; /* Darker borders */
        }
        .table-dark th {
            background-color: #000000; /* Darker header background */
        }
        thead th {
            background-color: black !important; /* Pastikan latar belakang hitam */
            color: white !important; /* Pastikan teks berwarna putih */
            text-transform: uppercase; /* Mengubah teks menjadi huruf kapital */
            border: 1px solid #ccc; /* Border abu-abu (opsional) */
        }
        .title-text {
            font-weight: bold; /* Menjadikan teks bold */
            text-decoration: underline; /* Menambahkan garis bawah */
            margin: 0; /* Menghapus margin default */
        }
    </style>


    <div class="card">
        <div class="card-header" style="display: flex; align-items: center;">
            <!-- Logo di sebelah kiri -->
            <div class="logo" style="flex: 1;">
                <img src="{{ asset('assets/images/logos.png') }}" alt="Logo" style="height: 40px;">
            </div>

            <!-- Teks di tengah -->
            <div class="title" style="flex: 2; text-align: center;">
                <h3 class="title-text">PREVENTIVE COUNT STROKE SYSTEM</h3>
            </div>

            <!-- Waktu di sebelah kanan -->
            <div class="time" id="current-time" style="flex: 1; text-align: right;">
                <!-- Waktu akan ditampilkan di sini -->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-dark"> <!-- Added 'table-dark' class -->
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Nama Dies</th>
                        <th scope="col">No Dies</th>
                        <th scope="col">Process</th>
                        <th scope="col">Machine</th>
                        <th scope="col" class="text-center">Interval</th>
                        <th scope="col" class="text-center">Current Stroke</th>
                        <th scope="col" class="text-center">Limit Stroke</th>
                        <th scope="col" class="text-center">% Stroke</th>
                        <th scope="col" class="text-center">Accumulative Stroke</th>
                        <th scope="col" class="text-center">Status</th> <!-- Kolom baru untuk status -->
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

            // Fetch current stroke data every seconds
            fetchCurrentStrokeData();
            setInterval(fetchCurrentStrokeData, 3000);
        });
    </script>
    <script>
        function updateTime() {
            const now = new Date();
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const day = days[now.getDay()];
            const date = now.getDate().toString().padStart(2, '0');
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const year = now.getFullYear();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            const timeString = `${day}, ${date}-${month}-${year} ${hours}:${minutes}:${seconds}`;
            document.getElementById('current-time').textContent = timeString;
        }

        // Update time every second
        setInterval(updateTime, 1000);

        // Call the function once to display the initial time
        updateTime();
    </script>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('assets/libs/js/dashboard-ecommerce.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
