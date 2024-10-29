<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembatalan Permintaan Stok</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #FF0000; /* Red header */
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #FF0000; /* Red headings */
            margin-bottom: 10px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
            padding: 20px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #FF0000; /* Red table border */
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #FF0000; /* Red table header */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ffe6e6; /* Light red hover */
        }
        a {
            color: #FF0000; /* Red links */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pembatalan Permintaan Stok</h1>
        </div>
        <div class="content">
            <h2>Dengan Hormat, {{ $nama }}!</h2>
            <p> Kami ingin memberitahukan Anda bahwa beberapa item permintaan yang tidak perlu ditinjaklanjuti (dibatalkan) .</p>
            <p>Berikut adalah daftar item yang perlu dibatalkan:</p>

            <!-- Table for item orders -->
            <table>
                <thead>
                    <tr>
                        <th>Nama Item</th>
                        <th>Order Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['qty_order'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Terima kasih atas perhatian Anda!</p>
            <p>Hormat kami,</p>
            <p>Divisi Tooling PT Mekar Armada Jaya</p>
        </div>
    </div>
</body>
</html>