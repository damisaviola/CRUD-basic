<?php
session_start();

// Periksa apakah sesi login admin ada atau sudah ditetapkan
if (!isset($_SESSION["username"])) {
    header("Location: halaman-login.php");
    exit();
}

// Koneksi ke database dan query untuk mendapatkan data admin
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
    <title>Daftar Admin</title>
    
</head>
<body>
    <h2>Daftar Admin</h2>
    
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
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
                echo "<td><a href='edit.php?nim=" . $row["nim"] . "'>Edit</a> | ";
                echo "<a href='hapus.php?nim=" . $row["nim"] . "'>Hapus</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data admin yang ditemukan.</td></tr>";
        }

        if (isset($_SESSION['update_message'])) {
            echo "<p>" . $_SESSION['update_message'] . "</p>";
            unset($_SESSION['update_message']);
        }
        ?>
    </table>
    
    <p><a href="dashboard-admin.php">Kembali ke Dashboard</a></p> 

    <?php
    mysqli_close($db);
    ?>
</body>
</html>
