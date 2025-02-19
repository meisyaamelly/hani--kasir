<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Cashier</title>

    <!-- Tambahkan favicon -->
    <link rel="icon" href="logokopi3.png" type="png">

    <!-- Link to external CSS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
    body {
        background: rgba(184, 212, 253, 0.767);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }


    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 40px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .login-container h2 {
        color: #0c0440;
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group {
        position: relative;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background: #f9f9f9;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group input:focus {
        border-color: #0c0440;
        box-shadow: 0 0 8px rgba(12, 4, 64, 0.4);
        outline: none;
        background: #fff;
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        background: #73bcf8;
        color: #353638;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
    }

    .btn-login:hover {
        background: #4f8af7;
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
    }

    .teks-info p {
        font-size: 14px;
        color: #dc3545;
        font-weight: 500;
        margin-top: 20px;
        text-align: center;
    }

    .error-message {
        font-size: 14px;
        color: #dc3545;
        text-align: center;
        margin-top: 15px;
    }

    .image-container {
        background-image: url('kasirr.png');
        /* Ganti dengan URL gambar Anda */
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        height: 60vh;
        /* Menyesuaikan ukuran gambar */
    }

    .form-group .fas {
        position: absolute;
        right: 12px;
        top: 70%;
        transform: translateY(-50%) translateY(2px);
        /* Menurunkan ikon 2px */
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="container-fluid d-flex">
        <div class="col-md-6 image-container"></div>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="login-container">
                <h2>Login</h2>
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="text" name="username" placeholder="Enter your email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fas fa-eye"></i> Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            class="form-control" required>
                        <i id="toggle-password" class="fas fa-eye"></i>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </form>
                @if (session('error'))
                <p class="error-message">{{ session('error') }}</p>
                @endif
                <div class="teks-info">
                    <p>Mohon login menggunakan akun petugas anda yang sudah terdaftar!</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const togglePassword = document.getElementById("toggle-password");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", function() {
            // Toggle type attribute
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle icon class
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    });
    </script>
</body>

</html>