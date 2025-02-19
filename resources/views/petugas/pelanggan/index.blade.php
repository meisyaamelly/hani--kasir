<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pelanggan</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style> 
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: rgba(184, 212, 253, 0.767);
    color: #333;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #2c3e50;
    font-size: 24px;
    margin-bottom: 20px;
}

.success-message {
    color: #27ae60;
    font-weight: bold;
    text-align: center;
    padding: 10px;
    background: #e8f5e9;
    border-radius: 5px;
}

.form-container {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.form-container label {
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
}

.form-container input[type="text"],
.form-container textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 14px;
    background: #fff;
    transition: border 0.3s ease;
}

.form-container input:focus,
.form-container textarea:focus {
    border-color: #4c93af;
    outline: none;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.2);
}

button {
    width: 100%;
    background: #3a9480;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button:hover {
    background: #4586a0;
}

/* Table Styling */
.table-container {
    overflow-x: auto;
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

thead {
    background: #34495e;
    color: white;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tbody tr:hover {
    background: #f1f1f1;
}

.edit-link {
    color: #2980b9;
    text-decoration: none;
    font-weight: bold;
}

.edit-link:hover {
    color: #1c5985;
}

.delete-link {
    color: #e74c3c;
    text-decoration: none;
    font-weight: bold;
}

.delete-link:hover {
    color: #c0392b;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 95%;
        padding: 15px;
    }

    table {
        font-size: 14px;
    }

    th, td {
        padding: 10px;
    }
}

</style>
<body>
    <div class="container">
        <h2>Form Tambah Pelanggan</h2>
        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
        <form method="POST" action="{{ url('/petugas/pelanggan') }}" class="form-container">
            @csrf
            <label for="NamaPelanggan">Nama Pelanggan:</label>
            <input type="text" name="NamaPelanggan" required>

            <label for="Alamat">Alamat:</label>
            <textarea name="Alamat" required></textarea>

            <label for="NomorTelepon">Nomor Telepon:</label>
            <input type="text" name="NomorTelepon" required>

            <button type="submit">Simpan</button>
        </form>

        <h2>Daftar Pelanggan</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Waktu Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $p)
                        <tr>
                            <td>{{ $p->PelangganID }}</td>
                            <td>{{ $p->NamaPelanggan }}</td>
                            <td>{{ $p->Alamat }}</td>
                            <td>{{ $p->NomorTelepon }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>
                                <a href="{{ url('/petugas/pelanggan/edit/' . $p->PelangganID) }}" class="edit-link">Edit</a> |
                                <a href="#" class="delete-link" onclick="confirmDelete({{ $p->PelangganID }})">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(pelangganID) {
            Swal.fire({
                title: "Yakin ingin menghapus pelanggan ini?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/petugas/pelanggan/delete/" + pelangganID;
                }
            });
        }
    </script>
</body>
</html>
