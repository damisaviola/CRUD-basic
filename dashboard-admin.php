<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: halaman-login.php");
    exit();
}


$server = "localhost";
$user = "root";
$password = "";
$nama_database = "db_ukm";

$db = mysqli_connect($server, $user, $password, $nama_database);

if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

$query = "SELECT * FROM admin";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Error: " . mysqli_error($db));
}
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        function konfirmasiHapus(nim) {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus admin dengan NIM " + nim + "?");

            if (konfirmasi) {
              
                window.location.href = "hapus.php?nim=" + nim;
            } else { 
                alert("Penghapusan dibatalkan.");
            }

            return false;
        }
    </script>

    <style>
        .card {
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 5000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

    
        .table-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #f0f0f0;
            padding: 20px;
        }

      
        .topnav {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }

        .topnav a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav a:hover {
            background-color: #007bff;
        }

        /* CSS untuk sidebar */
        nav {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 46px;
            left: 0;
            background-color: #ddd;
            padding-top: 20px;
            border-right: 1px solid #ccc;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 14px;
            font-weight: 100;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            margin-bottom: 10px;
        }

        nav a {
            text-decoration: none;
            color: black;
            display: block;
            padding: 10px 20px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #007bff;
        }

         .red:hover {
            background-color: red;
        }

            /* Additional styles */
    .registration-link {
        margin-top: 20px;
        text-align: right;
        margin-bottom: 30px;
    }

    .registration-link a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007BFF;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .registration-link a:hover {
        background-color: #0056b3;
    }


        
        .container {
            margin-left: 260px;
            margin-top: 50px;
            padding: 20px;
            color: black;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        nav ul li:last-child a:hover {
            background-color: red;
        }
    </style>
    <title>Dashboard Admin</title>
</head>
<body>
 
    <div class="topnav">
        <a href="#">Beranda</a>
        <a href="#">Tentang Kami</a>
    </div>

    
    <nav>
        <br> <br>
        <ul>
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="kalender.php">Pilihan Kalender</a></li>
            <li><a href="Registrasi.php">Daftar Admin</a></li>
            <li><a href="list-pendaftar.php">Form List Pendaftar</a></li>
            <li><a class="red" href="javascript:void(0);" onclick="konfirmasiLogout()">Logout</a><li>
        </ul>
    </nav>

   
    <div class="container">
        <h2>Selamat datang, <?php echo $_SESSION["nama_lengkap"]; ?>!</h2>
        <p>Ini adalah halaman dashboard admin.</p>

       
        <h2>Daftar Admin</h2>
        <div class="registration-link">
            <a href="registrasi.php">Registrasi Admin</a>
        </div>
        <div class="card">
            <table border="1">
                <tr>
                    <th>NIM</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Foto</th>
                    <th>Tindakan</th>
                   
                </tr>
                <?php
                if (isset($result) && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["nim"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["nama_lengkap"] . "</td>";
                        echo "<td><img src='uploads/{$row["admin_foto"]}' width='200'></td>";
                        echo "<td><a href='edit.php?nim=" . $row["nim"] . "'>Edit</a> | ";
                        echo "<a href='javascript:void(0);' onclick=\"konfirmasiHapus('".$row['nim']."')\">Hapus</a></td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data admin yang ditemukan.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <script>
    function konfirmasiLogout() {
        var konfirmasi = confirm("Apakah Anda yakin ingin logout?");

        if (konfirmasi) {
           
            window.location.href = "logout.php";
        }
    }
</script>
</body>
</html>
