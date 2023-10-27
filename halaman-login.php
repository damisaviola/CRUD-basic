<!DOCTYPE html>
<html>
<head>
    
    <title>Login Admin</title>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Login Admin</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();

                       
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

                          
                            $query = "SELECT * FROM admin WHERE username='$username'";
                            $result = mysqli_query($db, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);

                               
                                if (password_verify($password, $row["password"])) { // Memeriksa password dengan fungsi password verify
                                    // Password cocok, sesi login diinisialisasi di sini
                                    $_SESSION["username"] = $row["username"];
                                    $_SESSION["nim"] = $row["nim"];
                                    $_SESSION["nama_lengkap"] = $row["nama_lengkap"];

                                  
                                    header("Location: dashboard-admin.php");
                                    exit();
                                } else {
                                    
                                    echo '<div class="alert alert-danger" role="alert" id="errorAlert" style="display: block;">
                                              Password salah. Silakan coba lagi.
                                          </div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert" id="errorAlert" style="display: block;">
                                Data Tidak Ditemukan.
                            </div>';
                            }

                            mysqli_close($db);
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="showPassword">Show</button>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            
                            
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
   
        var passwordField = document.getElementById('password');
        var showPasswordButton = document.getElementById('showPassword');

        showPasswordButton.addEventListener('click', function () {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>
</html>
