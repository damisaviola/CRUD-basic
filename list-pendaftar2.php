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
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus admin dengan NIM " + nim + "?");

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

.search-container {
            text-align: right;
            margin-top: 20px;
            position: relative; /* Menambahkan posisi relatif untuk menyesuaikan ukuran input */
            width: 250px; /* Menentukan lebar kolom pencarian */
        }

        .search-container input[type="text"] {
            padding: 5px;
            margin-top: 5px;
            width: 100%;
        }
        .card {
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 5000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        /* CSS untuk container tabel */
        .table-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #f0f0f0;
            padding: 20px;
        }

        /* CSS untuk topnav */
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
            top: 48,5px;
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

        /* CSS untuk konten */
        .container {
            margin-left: 260px;
            margin-top: 50px;
            padding: 20px;
            color: black;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        /* CSS untuk tabel */
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

  
    </style>
    <title>Dashboard Admin</title>
</head>
<body>
    <!-- Topnav -->
    <div class="topnav">
        <a href="index.php">Beranda</a>
        <a href="#">Tentang Kami</a>
        <a href="#">Kontak</a>
        <div id="clock" style="color: white; float: right; padding: 14px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-seri"></div>
    </div>

    <!-- Sidebar -->
    <nav>
       
        <ul>
            <li><a href="kalender.php">Pilihan Kalender</a></li>
            <li><a href="daftar-ukm.php">Form UKM</a></li>
            <li><a href="list-pendaftar.php">Form List Pendaftar</a></li>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>

    <!-- Konten Dashboard -->
    <div class="container">
        <h2>Selamat datang,</h2>
        <p>Ini adalah halaman untuk mengedit data yang sudah di input <br>
        carilah data sesuai dengan nim.</p>
        <!-- Tampilkan daftar admin -->
        <h2>Pendaftar : </h2>
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari berdasarkan NIM...">
        </div> <br>
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
                    <th>Tindakan</th>
                </tr>
                <?php
        if (isset($result) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["nama"] . "</td>"; // Mengganti kolom 'nama' menjadi 'nama_lengkap'
                echo "<td>" . $row["nim"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["jenis_kelamin"] . "</td>";
                echo "<td>" . $row["jurusan"] . "</td>";
                echo "<td>" . $row["nim"] . "</td>";
                echo "<td>" . $row["fakultas"] . "</td>";
                echo "<td>" . $row["agama"] . "</td>";
                echo "<td>" . $row["ukm"] . "</td>";
                echo "<td><img src='uploads/{$row["user_foto"]}' width='100'></td>";
                echo "<td><a href='edit-daftar.php?nim=" . $row["nim"] . "'>Edit</a> | ";
                echo "<a href='javascript:void(0);' onclick=\"konfirmasiHapus('".$row['nim']."')\">Hapus</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>Tidak ada data admin yang ditemukan.</td></tr>";
        }
        ?>
            </table>
        </div>
</body>
</html>
