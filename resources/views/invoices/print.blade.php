<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header h1 {
            font-size: 24px;
            margin-top: 10px;
        }
        .details {
            margin-bottom: 30px;
        }
        .details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-size: 18px;
        }
        .total .label {
            margin-right: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header dengan logo dan judul -->
    <div class="header">
        <img src="{{ asset('path_to_logo/logo_umkm.png') }}" alt="Logo UMKM">
        <h1>Invoice Transaksi</h1>
    </div>

    <!-- Informasi Transaksi -->
    <div class="details">
        <p><strong>Nama Pembeli:</strong> {{ $transaction->nama_pembeli }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($transaction->tanggal_transaksi)->format('d-m-Y') }}</p>
    </div>

    <!-- Tabel Produk -->
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp
            @foreach($details as $detail)
                @php
                    $totalPrice = $detail->jumlah * $detail->harga;
                    $totalAmount += $totalPrice;
                @endphp
                <tr>
                    <td>{{ $detail->product->nama }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ number_format($detail->harga, 2) }}</td>
                    <td>{{ number_format($totalPrice, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Keseluruhan -->
    <div class="total">
        <span class="label"><strong>Total:</strong></span>
        <span>{{ number_format($totalAmount, 2) }}</span>
    </div>
</div>

</body>
</html>
