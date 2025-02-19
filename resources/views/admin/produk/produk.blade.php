<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        background-color: rgba(255, 255, 255, 0.1);
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
        margin-left: 130px;
        padding: 20px;
        background:rgba(217, 227, 250, 0.9);
        transition: margin-left 0.3s ease;
        overflow-y: auto;
    }

    .navbar {
        margin-left: 130px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #34495e;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #3498db;
        color: white;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    .action-buttons a {
        margin-right: 10px;
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .action-buttons a.edit {
        background-color: #f39c12;
        color: white;
    }

    .action-buttons a.delete {
        background-color: #e74c3c;
        color: white;
    }

    .action-buttons a:hover {
        opacity: 0.8;
    }

    .success-message {
        color: green;
        font-weight: bold;
    }

    .search-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-bar a.btn-add {
        margin-right: auto;
        padding: 10px 15px;
        background-color: #3498db;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .search-bar a.btn-add:hover {
        background-color: #2980b9;
    }

    .search-bar input {
        padding: 10px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    /* drop down*/

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        padding: 5px 0;
        right: 0;
        top: 30px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        z-index: 1000;
        width: 150px;
    }

    .dropdown-menu button {
        background: none;
    border: none;
    padding: 10px 15px;
    width: 100%;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
    color: #333;
    transition: background-color 0.3s ease;
    }

    .dropdown-menu button:hover {
        background-color: #f1f1f1;
    }
    </style>

</head>

<body>
    <div class="sidebar">
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
                        <button type="submit" class="dropdown-item">Log Out</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container">
                <h2>List Produk</h2>
                <div class="search-bar">
                    <a href="{{ url('/admin/produk/create') }}" class="btn-add">Tambah Produk</a>
                    <input type="text" id="searchInput" placeholder="Cari produk...">
                </div>


                @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
                @endif

                <table>
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        @foreach ($produk as $p)
                        <tr>
                            <td>{{ $p->ProdukID }}</td>
                            <td>{{ $p->NamaProduk }}</td>
                            <td>{{ $p->Kategori }}</td>
                            <td>Rp {{ number_format($p->Harga, 0, ',', '.') }}</td>
                            <td>{{ $p->Stok }}</td>
                            <td class="action-buttons">
                                <a href="{{ url('/admin/produk/edit/' . $p->ProdukID) }}" class="edit">Edit</a>
                                <a href="{{ url('/admin/produk/delete/' . $p->ProdukID) }}" class="delete"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script>
        window.onload = function() {
            const searchInput = document.getElementById('searchInput');
            const rows = document.querySelectorAll('#productTable tr');

            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();

                rows.forEach(row => {
                    const productName = row.querySelector('td:nth-child(2)')?.textContent
                        .toLowerCase() || '';
                    const category = row.querySelector('td:nth-child(3)')?.textContent
                    .toLowerCase() || '';

                    if (productName.includes(searchValue) || category.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        };

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
        
        </script>
</body>

</html>