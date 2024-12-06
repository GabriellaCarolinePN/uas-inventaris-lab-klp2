<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: linear-gradient(135deg, #FAAF78, #FBEAFF, #48BEC8);
            background-size: 400% 400%;
            animation: gradientAnimation 6s ease infinite;
            color: #333;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .login-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background-color: #48BEC8;
            border-color: #48BEC8;
        }
        .btn-primary:hover {
            background-color: #399BA3;
            border-color: #399BA3;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(72, 190, 200, 0.8);
            border-color: #48BEC8;
        }
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card login-card p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Admin Login</h3>
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <!-- Username -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <!-- Password -->
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        <span class="input-group-text bg-white password-toggle" id="togglePassword">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <!-- Login Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary text-white">Login</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Script for Hide/Unhide Password -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    </script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
</body>
</html>
