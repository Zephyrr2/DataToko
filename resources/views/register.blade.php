<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <link rel="stylesheet" href="{{asset('css/registerform.css')}}">
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4">Register</h2>
                    <form action="{{ url('register/process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_admin" class="form-label">Nama Admin</label>
                            <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>