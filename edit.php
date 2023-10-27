<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pengguna</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container mt-5">
        <?php
        $server = "localhost";
        $user = "root";
        $password = "";
        $nama_database = "db_ukm";

        $db = mysqli_connect($server, $user, $password, $nama_database);

        if (!$db) {
            die("Gagal terhubung dengan database: " . mysqli_connect_error());
        }

        $nim = "";
        $nama_lengkap = "";
        $username = "";
        $email = "";
        $password = "";

        if (isset($_GET["nim"])) {
            $nim = $_GET["nim"];

            $query = "SELECT * FROM admin WHERE nim = '$nim'";
            $result = mysqli_query($db, $query);

            if (!$result) {
                die("Query gagal: " . mysqli_error($db));
            }

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $nim = $row['nim'];
                $nama_lengkap = $row['nama_lengkap'];
                $username = $row['username'];
                $email = $row['email'];
                $password = $row['password'];
            } else {
                echo "Data tidak ditemukan.";
            }
        }

        if (isset($_POST['update'])) {
            $newNim = $_POST['nim'];
            $newNamaLengkap = $_POST['nama_lengkap'];
            $newUsername = $_POST['username'];
            $newEmail = $_POST['email'];
            $oldPassword = $_POST['old_password']; // Password lama yang dimasukkan oleh pengguna
            $newPassword = $_POST['new_password']; // Password baru yang dimasukkan oleh pengguna

            // Validasi password lama dengan password yang ada di database
            if (!password_verify($oldPassword, $password)) {
                echo '<div class="alert alert-danger" role="alert">Password lama tidak valid. Silakan coba lagi.</div>';
            } else {
                // Password lama valid, Anda dapat mengizinkan pengguna untuk mengubah password
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateQuery = "UPDATE admin SET nim = '$newNim', nama_lengkap = '$newNamaLengkap', username = '$newUsername', email = '$newEmail', password = '$hashedNewPassword' WHERE nim = '$nim'";
                $updateResult = mysqli_query($db, $updateQuery);

                if (!$updateResult) {
                    die("Update gagal: " . mysqli_error($db));
                } else {
                    session_start();
                    $_SESSION['update_message'] = "Update berhasil";
                    header("Location: dashboard-admin.php");
                    exit;
                }
            }
        }
        ?>

        <div class="card">
            <div class="card-body">
                <h2 class="mb-4">Edit Data Admin</h2>
                <form method="post" action="">
                    <input type="hidden" name="nim" value="<?php echo $nim; ?>">
                    <div class="form-group">
                        <label for="nim">NIM:</label>
                        <input type="text" class="form-control" name="nim" value="<?php echo $nim; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap:</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="old_password">Password Lama:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="old_password" id="old_password">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('old_password')">Lihat</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="new_password" id="new_password">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('new_password')">Lihat</button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update" onclick="return konfirmasiEdit();">Edit</button>
                </form>
            </div>
        </div>

        <a href="dashboard-admin.php" class="mt-3 btn btn-secondary">Kembali ke Daftar Pengguna</a>
    </div>
    <script>
    function konfirmasiEdit() {
        var konfirmasi = window.confirm("Apakah Anda yakin ingin Mengedit data tersebut?");
        if (konfirmasi) {
            return true;
        } else {
            alert("Edit dibatalkan.");
            return false;
        }
    }

    function togglePasswordVisibility(inputId) {
        var input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
