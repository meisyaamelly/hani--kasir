<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Employee</title>
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
        }

        .sidebar .brand {
            padding: 20px;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 15px;
        }

        .content {
            background:rgba(217, 227, 250, 0.9);
            flex: 1;
            margin-left: 260px;
            padding: 20px;
            overflow-y: auto;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        h2 {
            font-size: 24px;
            color: #34495e;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #27ae60;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">Admin Panel</div>
        <ul>
            <li><a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/admin/produk"><i class="fas fa-box"></i> Produk</a></li>
            <li><a href="/admin/employees"><i class="fas fa-users"></i> Employees</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="navbar">
            <div>Welcome, Admin</div>
            <div><i class="fas fa-user-circle" style="font-size: 24px;"></i></div>
        </div>

        <div class="container">
            <h2>Tambah Employee</h2>
            <form method="POST" action="{{ url('/admin/employees/store') }}">
                @csrf
                <label for="name">Nama:</label>
                <input type="text" name="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>
                
                <label for="address">Address:</label>
                <input type="text" name="address" required>

                <button type="submit">Simpan</button>
                <a href="{{ url('/admin/employees') }}">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>
