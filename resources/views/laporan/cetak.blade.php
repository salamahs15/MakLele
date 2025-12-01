<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 40px;
            font-size: 14px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f3f3f3;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>ID Transaksi</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $index => $t)
                <tr>
                    <td>{{ $t->created_at->format('d-m-Y') }}</td>
                    <td>{{ str_pad($t->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>Rp.{{ number_format($t->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Penjualan : Rp. {{ number_format($total, 0, ',', '.') }}</p>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>
    </div>
</body>
</html>
