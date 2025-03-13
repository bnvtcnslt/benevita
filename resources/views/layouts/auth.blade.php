<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex; /* Menggunakan flexbox */
            justify-content: center; /* Memusatkan secara horizontal */
            align-items: center; /* Memusatkan secara vertikal */
            height: 100vh; /* Mengatur tinggi body agar 100% dari viewport */
            margin: 0; /* Menghapus margin default */
        }

        .login-container {
            max-width: 400px;
            width: 90%; /* Memastikan lebar 90% pada mobile */
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .input-group-append .btn {
            border: none;
            background: transparent;
        }
        .input-group-append .btn:hover {
            background: transparent;
        }
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%; /* Mengatur posisi vertikal ke tengah */
            transform: translateY(-50%); /* Menggeser ikon ke tengah secara vertikal */
            cursor: pointer;
        }
        .password-container {
            position: relative;
        }

        .form-control {
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #6c757d;
            box-shadow: none;
        }
        .form-control:hover {
            border-color: #6c757d;
            background-color: #e9ecef;
        }

        /* Media Query untuk Responsivitas */
        @media (max-width: 576px) {
            .eye-icon {
                top: 50%; /* Menjaga posisi ikon mata di tengah */
                transform: translateY(-50%); /* Menggeser ikon ke tengah secara vertikal */
            }
        }
    </style>
</head>
<body>

@yield('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Script untuk toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');
    const eyeIcon = document.querySelector('#togglePassword');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        // Toggle the eye / eye slash icon
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const newPasswordInput = document.getElementById('new_password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirm_password');

        if (togglePassword) {
            togglePassword.addEventListener('click', function () {
                const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                newPasswordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        }

        if (toggleConfirmPassword) {
            toggleConfirmPassword.addEventListener('click', function () {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>

<!-- JavaScript untuk mengelola tampilan dan percobaan login -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let loginAttempts = sessionStorage.getItem("loginAttempts") ? parseInt(sessionStorage.getItem("loginAttempts")) : 0;
        let isAdminConfirmed = sessionStorage.getItem("isAdminConfirmed");

        // Cek apakah sudah dikonfirmasi admin dan jumlah percobaan login
        if (isAdminConfirmed === "true" && loginAttempts <= 6) {
            showLoginForm();
        }

        document.getElementById("btnYesAdmin").addEventListener("click", function() {
            sessionStorage.setItem("isAdminConfirmed", "true");
            sessionStorage.setItem("loginAttempts", "0");
            showLoginForm();
        });

        document.getElementById("btnNotAdmin").addEventListener("click", function() {
            window.location.href = "{{ route('home') }}";
        });

        document.getElementById("loginForm").addEventListener("submit", function (event) {
            loginAttempts++;
            sessionStorage.setItem("loginAttempts", loginAttempts);

            if (loginAttempts >= 6) {
                event.preventDefault();
                $("#failedLoginModal").modal("show");
            }
        });

        document.getElementById("retryAdminConfirm").addEventListener("click", function() {
            sessionStorage.removeItem("isAdminConfirmed");
            sessionStorage.setItem("loginAttempts", "0");
            location.reload();
        });
    });

    function showLoginForm() {
        document.getElementById('adminConfirmation').style.display = 'none';
        document.getElementById('loginTitle').style.display = 'block';
        document.getElementById('loginForm').style.display = 'block';

        var messageBox = document.getElementById('loginMessage');
        if (messageBox) {
            messageBox.style.display = 'block';
        }
    }
</script>
</body>
</html>
