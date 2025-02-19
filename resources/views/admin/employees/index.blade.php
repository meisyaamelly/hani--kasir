<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background:rgba(217, 227, 250, 0.9);
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
    }

    h2 {
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

    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .modal-content p {
        margin-bottom: 20px;
    }

    .modal-buttons a {
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .modal-buttons .confirm {
        background: #e74c3c;
        color: white;
    }

    .modal-buttons .cancel {
        background: #7f8c8d;
        color: white;
        margin-left: 10px;
    }

    .search-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.search-bar a.btn-add {
    margin-right: auto; /* Agar tombol tetap di kiri */
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

   <div class="content" id="content">
        <div class="navbar">
            <div>Welcome, Admin</div>
            <div class="dropdown">
    <i class="fas fa-user-circle" style="font-size: 24px; cursor: pointer;" id="userIcon"></i>
    <div class="dropdown-menu" id="dropdownMenu">
        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item" style="background: none; border: none; padding: 10px 15px; width: 100%; text-align: left; cursor: pointer;">
                Log Out
            </button>
        </form>
    </div>
</div>
        </div>

        <div class="container">
            <h2>Daftar Employee</h2>
            <div class="search-bar">
                <a href="{{ url('/admin/employees/create') }}" class="btn-add">Tambah Employee</a>
                <input type="text" id="search" placeholder="Cari Employee...">
            </div>


            @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
            @endif

            <table id="employeeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->role }}</td>
                        <td class="action-buttons">
                            <a href="{{ url('/admin/employees/edit/' . $employee->id) }}" class="edit">Edit</a>
                            <a href="{{ url('/admin/employees/delete/' . $employee->id) }}" class="delete" onclick="return confirm('Yakin ingin menghapus employee ini?')">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
    document.getElementById('search').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#employeeTable tbody tr');

        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            if (name.includes(searchValue) || email.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    let deleteUrl = '';

    function showModal(employeeId) {
        deleteUrl = `/admin/employees/delete/${employeeId}`;
        document.getElementById('deleteModal').style.display = 'flex';
        document.getElementById('confirmDelete').setAttribute('href', deleteUrl);
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    const userIcon = document.getElementById('userIcon');
    const dropdownMenu = document.getElementById('dropdownMenu');

    userIcon.addEventListener('click', function(event) {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        event.stopPropagation(); // Mencegah event bubbling
    });

    document.addEventListener('click', function() {
        dropdownMenu.style.display = 'none';
    });

    dropdownMenu.addEventListener('click', function(event) {
        event.stopPropagation(); // Mencegah dropdown menutup saat tombol di klik
    });
    </script>
</body>

</html>