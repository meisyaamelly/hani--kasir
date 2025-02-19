<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background:rgba(167, 224, 250, 0.9);
        margin: 0;
        padding: 0;
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    .sidebar {
        width: 260px;
        background:rgb(123, 191, 255);
        color: white;
        position: fixed;
        height: 100%;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar .brand {
        padding: 20px;
        font-size: 22px;
        font-weight: bold;
        text-align: center;
        background-color: rgba(0, 0, 0, 0.1);
        letter-spacing: 1px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar ul li {
        padding: 15px 20px;
        transition: all 0.3s ease;
        position: relative;
    }

    .sidebar ul li:hover {
        background-color: rgba(85, 153, 255, 0.1);
        cursor: pointer;
    }

    .sidebar ul li a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        font-size: 16px;
    }

    .sidebar ul li a i {
        margin-right: 15px;
        font-size: 18px;
    }

    .content {
        flex: 1;
        margin-left: 260px;
        padding: 20px;
        transition: margin-left 0.3s ease;
        overflow-y: auto;
        background:rgba(217, 227, 250, 0.9);

    }

    .content.collapsed {
        margin-left: 80px;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .cards {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        padding: 20px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s ease;
        min-width: 200px;
    }

    .card i {
        font-size: 40px;
        color: #3498db;
    }

    .card:hover {
        background-color: #f1f1f1;
        transform: translateY(-5px);
    }

    .card h3 {
        margin: 0;
        font-size: 16px;
        color: #555;
    }

    .card p {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
        color: #333;
    }


    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table thead th {
        background-color: #3498db;
        color: white;
        padding: 12px 15px;
        text-align: left;
    }

    table tbody tr {
        transition: all 0.3s ease;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    table tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }

    .action-buttons button {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-right: 5px;
    }

    .action-buttons button.view {
        background-color: #1e88e5;
        color: white;
    }

    .action-buttons button.delete {
        background-color: #e53935;
        color: white;
    }

    .action-buttons button:hover {
        opacity: 0.8;
    }

    /* drop down*/

    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        top: 35px;
        right: 0;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 1000;
        width: 120px;
    }

    .dropdown-menu a {
        padding: 10px 15px;
        display: block;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .dropdown-menu a:hover {
        background-color: #f1f1f1;
    }

    /* modal detai penjualan */
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        /* Modal tidak tampil di awal */
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 80%;
        max-width: 600px;
    }

    .modal-content h2 {
        margin-top: 0;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    #detailTable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    #detailTable th,
    #detailTable td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    #detailTable th {
        background-color: #3498db;
        color: white;
    }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="brand">Admin Panel</div>
        <ul>
            <li><a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/admin/employees"><i class="fas fa-users"></i> Employees</a></li>
            <li><a href="/admin/produk"><i class="fas fa-box"></i> Products</a></li>
        </ul>
    </div>

    <div class="content" id="content">
        <div class="navbar">
            <div>Welcome, Admin</div>
            <div class="dropdown">
                <i class="fas fa-user-circle" style="font-size: 24px; cursor: pointer;" id="userIcon"></i>
                <div class="dropdown-menu" id="dropdownMenu">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"
                            style="background: none; border: none; padding: 10px 15px; width: 100%; text-align: left; cursor: pointer;">Log
                            Out</button>
                    </form>
                </div>
            </div>
        </div>

        <h1>Dashboard Admin</h1>
        <div class="cards">
            <div class="card">
                <i class="fas fa-user"></i>
                <div>
                    <h3>Employee</h3>
                    <p>{{ isset($totalEmployee) ? $totalEmployee : 'Data not found' }}</p>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-user-shield"></i>
                <div>
                    <h3>Admin</h3>
                    <p>{{ $totalAdmin }}</p>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <div>
                    <h3>Transaksi</h3>
                    <p>{{ $totalTransaksi }}</p>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-box-open"></i>
                <div>
                    <h3>Produk</h3>
                    <p>{{ $totalProduct }}</p>
                </div>
            </div>
        </div>

        <h2>Data Penjualan</h2>
        <table id="salesTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penjualan ID</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total Harga</th>
                    <th>Pelanggan ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $index => $sale)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sale->PenjualanID }}</td>
                    <td>{{ $sale->TanggalPenjualan }}</td>
                    <td>Rp {{ number_format($sale->TotalHarga, 0, ',', '.') }}</td>
                    <td>{{ $sale->PelangganID }}</td>
                    <td class="action-buttons">
                        <button class="view">View</button>
                        <button class="btn btn-danger"
                            onclick="confirmDelete('{{ $sale->PenjualanID }}')">Hapus</button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Tambahkan Modal Detail -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Detail Penjualan</h2>
            <table id="detailTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="modalDetailContent">
                    <!-- Data detail akan dimuat di sini melalui AJAX -->
                </tbody>
            </table>
        </div>
    </div>


    <script>
    $(document).ready(function() {
        $('#salesTable').DataTable();

        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        document.addEventListener('keydown', function(e) {
            if (e.key === 'c') {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('collapsed');
            }
        });
    });

    $(document).ready(function() {
        $('#userIcon').on('click', function() {
            $('#dropdownMenu').toggle();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('#dropdownMenu').hide();
            }
        });
    });

    //modal detail penjualan
    $(document).ready(function() {
        // Event klik tombol "View" untuk menampilkan modal
        $('.view').on('click', function() {
            const penjualanID = $(this).closest('tr').find('td:nth-child(2)').text();

            // Panggil AJAX untuk mengambil data detail penjualan
            $.ajax({
                url: `/penjualan/detail/${penjualanID}`,
                method: 'GET',
                success: function(data) {
                    let rows = '';
                    data.forEach((item, index) => {
                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nama_produk}</td>
                                <td>${item.jumlah}</td>
                                <td>Rp ${Number(item.harga_satuan).toLocaleString('id-ID')}</td>
                                <td>Rp ${Number(item.subtotal).toLocaleString('id-ID')}</td>
                            </tr>
                        `;
                    });
                    $('#modalDetailContent').html(rows);
                    $('#detailModal').css('display',
                    'flex'); // Tampilkan modal di tengah layar
                },
                error: function() {
                    alert('Gagal mengambil data detail penjualan.');
                }
            });
        });

        // Event klik tombol "close" untuk menutup modal
        $('.close').on('click', function() {
            $('#detailModal').fadeOut();
        });

        // Event klik di luar modal-content untuk menutup modal
        $(document).on('click', function(e) {
            if ($(e.target).is('#detailModal')) {
                $('#detailModal').fadeOut();
            }
        });
    });



    //delete
    function confirmDelete(penjualanID) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/penjualan/delete/${penjualanID}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then(() => {
                            location.reload(); // Refresh halaman setelah sukses
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
    </script>
</body>

</html>