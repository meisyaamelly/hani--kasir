<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: rgba(249, 229, 193, 0.9);
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
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.2);
}

button {
    width: 100%;
    background: #4CAF50;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
    display: inline-block;
    text-align: center;
}

button:hover {
    background: #45a049;
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

th,
td {
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

    th,
    td {
        padding: 10px;
    }
}

.back-button {
    display: inline-block;
    width: 100%;
    text-align: center;
    background: #e74c3c;
    color: white;
    padding: 12px;
    margin-top: 10px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    transition: background 0.3s ease;
}

.back-button:hover {
    background: #c0392b;
}
</style>

<body>
    <div class="container">
        <h2>Edit Pelanggan</h2>
        <form method="POST" action="{{ url('/petugas/pelanggan/update/' . $pelanggan->PelangganID) }}"
            class="form-container">
            @csrf
            <label for="NamaPelanggan">Nama Pelanggan:</label>
            <input type="text" name="NamaPelanggan" value="{{ $pelanggan->NamaPelanggan }}" required>

            <label for="Alamat">Alamat:</label>
            <textarea name="Alamat" required>{{ $pelanggan->Alamat }}</textarea>

            <label for="NomorTelepon">Nomor Telepon:</label>
            <input type="text" name="NomorTelepon" value="{{ $pelanggan->NomorTelepon }}" required>

            <button type="submit">Update</button>
            <a href="{{ url('/petugas/pelanggan') }}" class="back-button">Batal</a>
        </form>
    </div>
</body>

</html>