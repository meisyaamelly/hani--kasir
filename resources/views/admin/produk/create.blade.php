<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: rgba(178, 208, 253, 0.767);
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
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
            overflow-y: auto;
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

        .container {
            max-width: 800px;
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

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        button {
            background-color: #27ae60;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #218c53;
        }

        a {
            text-decoration: none;
            color: #3498db;
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #2980b9;
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

    <div class="content">
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

        <div class="container">
            <h2>Tambah Produk</h2>
            <form method="POST" action="{{ url('/admin/produk/store') }}" enctype="multipart/form-data">
                @csrf
                <label for="NamaProduk">Nama Produk:</label>
                <input type="text" name="NamaProduk" required>

                <label for="Harga">Harga:</label>
                <input type="number" name="Harga" required>

                <label for="Stok">Stok:</label>
                <input type="number" name="Stok" required>

                <label for="Kategori">Kategori:</label>
                <select name="Kategori" required>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </select>

                <div class="form-group">
                    <label for="image">Upload Gambar Produk:</label>
                    <input type="file" name="image" accept="image/*">
                </div>

                <button type="submit">Simpan</button>
                <a href="{{ url('/admin/produk') }}">Batal</a>
            </form>
        </div>
    </div>
    
    <script>
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
