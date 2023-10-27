<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "db_ukm";

$db = mysqli_connect($server, $user, $password, $nama_database);

if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nim = $_POST["nim"];
    $email = $_POST["email"];
    $nama_lengkap = $_POST["nama_lengkap"];

    if (isset($_FILES['foto'])) {
        $foto_name = $_FILES['foto']['name'];
        $foto_temp = $_FILES['foto']['tmp_name'];
        $foto_folder = "uploads/";
        $uploadfile = $foto_folder . $foto_name;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (isset($foto_name) && move_uploaded_file($foto_temp, $uploadfile)) {
        // Query untuk menyimpan data admin ke database
        $query = "INSERT INTO admin (username, password, nim, email, nama_lengkap, admin_foto) VALUES ('$username', '$hashed_password', '$nim', '$email', '$nama_lengkap', '$foto_name')";

        if (mysqli_query($db, $query)) {
            echo '<div class="alert alert-success" role="alert">
                      Registrasi berhasil. Anda dapat <a href="halaman-login.php">login sekarang</a>.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                      Terjadi kesalahan. Silakan coba lagi.
                  </div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
                  Gagal mengunggah gambar. Pastikan Anda telah memilih file gambar.
              </div>';
    }
}




?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrasi Admin</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Registrasi Admin</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="showPassword">Tampilkan</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nim">NIM:</label>
                                <input type="text" class="form-control" id="nim" name="nim" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap:</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto (JPEG/PNG):</label>
                                <input type="file" class="form-control-file" name="foto" id="foto">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        var passwordField = document.getElementById('password');
        var showPasswordButton = document.getElementById('showPassword');

        showPasswordButton.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>

</html>