<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #dfe9f3, #ffffff);
            color: #2c3e50;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            overflow: hidden;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 70px;
        }

        .header h1 {
            font-size: 32px;
            color: #34495e;
            margin: 10px 0;
        }

        .date-time {
            text-align: center;
            font-size: 16px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .info div {
            flex: 1 1 calc(50% - 15px);
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
        }

        table th {
            background: #2980b9;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        table tbody tr:nth-child(even) {
            background: #f2f2f2;
        }

        table tbody tr:hover {
            background: #dcdde1;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 20px;
        }

        .summary div {
            flex: 1;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            text-align: right;
            font-size: 14px;
        }

        .btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease, transform 0.2s ease;
            margin: 0 10px;
        }

        .btn-print {
            background: #27ae60;
            color: white;
        }

        .btn-print:hover {
            background: #2ecc71;
            transform: translateY(-3px);
        }

        .btn-back {
            background: #e74c3c;
            color: white;
        }

        .btn-back:hover {
            background: #c0392b;
            transform: translateY(-3px);
        }

        .date-time {
    font-size: 18px;
    font-weight: bold;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 20px;
}


    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ asset('kasirr.png') }}" alt="Logo Perusahaan">
            <h1>HANNIES STORE</h1>
        </div>

        <p class="date-time">
    Tanggal: {{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->format('d M Y') }} <span id="current-time"></span>
</p>


        <div class="info">
            <div><strong>Nama Pelanggan:</strong><br>{{ $penjualan->NamaPelanggan }}</div>
            <div><strong>Nomor Telepon:</strong><br>{{ $penjualan->NomorTelepon }}</div>
            <div style="flex: 1;"><strong>Alamat:</strong><br>{{ $penjualan->Alamat }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailPenjualan as $item)
                <tr>
                    <td>{{ $item->NamaProduk }}</td>
                    <td>Rp {{ number_format($item->Harga, 0, ',', '.') }}</td>
                    <td>{{ $item->JumlahProduk }}</td>
                    <td>Rp {{ number_format($item->Subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div><strong>Nominal Pembayaran:</strong> Rp {{ number_format($detailPenjualan->first()->NominalPembayaran, 0, ',', '.') }}</div>
            <div><strong>Kembalian:</strong> Rp {{ number_format($detailPenjualan->first()->NominalPembayaran - $penjualan->TotalHarga, 0, ',', '.') }}</div>
        </div>

        <div class="btn-container">
            <a href="#" class="btn btn-print" onclick="window.print()">Cetak Struk</a>
            <a href="/petugas/pelanggan" class="btn btn-back" onclick="clearLocalStorage()">Kembali</a>
        </div>
    </div>

    <script>
    function calculateChange() {
        let total = {
            {
                $penjualan - > TotalHarga
            }
        };
        let payment = parseInt(document.getElementById('paymentInput').value.replace(/[^\d]/g, '')) || 0;
        let change = payment - total;
        let changeElement = document.getElementById('changeAmount');

        if (change >= 0) {
            changeElement.innerText = 'Rp ' + change.toLocaleString();
        } else {
            changeElement.innerText = 'Rp 0';
        }
    }

    document.getElementById('paymentInput').addEventListener('input', calculateChange);

    function updateTime() {
        const timeElement = document.getElementById('current-time');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        timeElement.textContent = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateTime, 1000);
    updateTime(); // Jalankan fungsi saat halaman pertama kali dimuat

        function clearLocalStorage() {
            localStorage.clear();
        }
    </script>

</body>

</html>