<?php
session_start();

// Koneksi ke database
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "db_ukm";

$db = mysqli_connect($server, $user, $password, $nama_database);

if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

$query = "SELECT * FROM daftar_ukm";
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
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data dengan NIM " + nim + "?");

            if (konfirmasi) {
                // Jika pengguna menyetujui penghapusan, arahkan ke "hapus.php"
                window.location.href = "hapusPendaftar.php?nim=" + nim;
            } else {
                // Jika pengguna membatalkan penghapusan, tampilkan alert
                alert("Penghapusan dibatalkan.");
            }

            // Kembalikan false agar tautan tidak diikuti saat alert muncul
            return false;
        }
    </script>



    <script>
        // Fungsi untuk mengupdate jam dan tanggal secara real-time
        function updateClock() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var day = currentTime.getDate();
            var month = currentTime.getMonth() + 1; // Bulan dimulai dari 0 (Januari) hingga 11 (Desember)
            var year = currentTime.getFullYear();

            // Format waktu dengan menambahkan 0 di depan jika angka < 10
            hours = (hours < 10 ? "0" : "") + hours;
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;
            day = (day < 10 ? "0" : "") + day;
            month = (month < 10 ? "0" : "") + month;

            // Tampilkan waktu dalam format HH:MM:SS
            var timeString = hours + ":" + minutes + ":" + seconds;

            // Tampilkan tanggal dalam format DD/MM/YYYY
            var dateString = day + "/" + month + "/" + year;

            // Perbarui elemen dengan id "clock" dengan waktu dan tanggal yang baru
            document.getElementById("clock").innerHTML = timeString + " - " + dateString;
        }

        // Panggil fungsi updateClock() setiap detik
        setInterval(updateClock, 1000);
    </script>


<style>
    body {
        background-color: #f5f5f5;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* Topnav styles */
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
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .topnav a:hover {
        background-color: #007bff;
    }

    /* Sidebar styles */
    nav {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #ddd;
        padding-top: 20px;
        border-right: 1px solid #ccc;
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

    /* Container styles */
    .container {
        margin-left: 260px;
        margin-top: 50px;
        padding: 20px;
        color: black;
    }

    /* Table styles */
    table {
        border-collapse: collapse;
        width: 100%;
        overflow-x: auto;
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

    @media (max-width: 600px) {
        th, td {
            padding: 4px;
        }
    }

    /* Additional styles */
    .registration-link {
        margin-top: 20px;
        text-align: right;
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

    .search-container {
        text-align: right;
        margin-top: 20px;
        position: relative;
        width: 250px;
    }

    .search-container input[type="text"] {
        padding: 5px;
        margin-top: 5px;
        width: 100%;
    }

    .card {
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-sizing: border-box;
        overflow-x: auto;
    }
</style>

    <title>Dashboard</title>
</head>

<body>
    <!-- Topnav -->
    <div class="topnav">
        <div id="clock" style="color: white; float: right; padding: 14px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-seri"></div>
    </div>

    <!-- Sidebar -->
    <nav>

        <ul>
            <li><a href="kalender.php">Pilihan Kalender</a></li>
            <li><a href="daftar-ukm.php">Daftar UKM</a></li>
            <li><a href="list-pendaftar2.php">Edit Data</a></li>
            <li><a href="dashboard-admin.php">Admin</a></li>
        </ul>
    </nav>

    <!-- Konten Dashboard -->
    <div class="container">
        <h2>Selamat datang,</h2>
        <p>Ini adalah halaman dashboard </p>
        <!-- Tampilkan daftar admin -->
        <h2>Pendaftar : </h2>
        
        <div class="search-container">

        </div> <br>
        <div class="registration-link">
            <a href="daftar-ukm.php">Mendaftar Baru</a>
        </div>
        <br> <br>
        <div class="card">
            <table border="1">
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Nim</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Prodi</th>
                    <th>Nim</th>
                    <th>Fakultas</th>
                    <th>Agama</th>
                    <th>Pilihan UKM</th>
                    <th>Foto</th>
                </tr>
                <?php
                if (isset($result) && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["nim"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td>" . $row["jenis_kelamin"] . "</td>";
                        echo "<td>" . $row["fakultas"] . "</td>";
                        echo "<td>" . $row["nim"] . "</td>";
                        echo "<td>" . $row["jurusan"] . "</td>";
                        echo "<td>" . $row["agama"] . "</td>";
                        echo "<td>" . $row["ukm"] . "</td>";
                        echo "<td><img src='uploads/{$row["user_foto"]}' width='100'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='100'>Tidak ada data pendaftar yang ditemukan.</td></tr>";
                }
                ?>
            </table>
        </div>
</body>

</html>