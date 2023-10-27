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

// Periksa apakah parameter "nim" telah diberikan dalam URL
if (isset($_GET["nim"])) {
    $nim = $_GET["nim"];

    // Query SQL untuk menghapus data admin berdasarkan NIM
    $query = "DELETE FROM admin WHERE nim = '$nim'";

    // Eksekusi query DELETE
    $result = mysqli_query($db, $query);

    if ($result) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman daftar-admin dengan pesanQ sukses
        $_SESSION['update_message'] = "Data admin dengan NIM $nim berhasil dihapus.";
        header("Location: halaman-login.php");
        exit();
    } else {
        // Jika penghapusan gagal, tampilkan pesan kesalahan
        $_SESSION['update_message'] = "Error: " . mysqli_error($db);
        header("Location: halaman-login.php");
        exit();
    }
} else {
    // Jika parameter "nim" tidak diberikan dalam URL, tampilkan pesan kesalahan
    $_SESSION['update_message'] = "NIM admin tidak diberikan.";
    header("Location: halaman-login.php");
    exit();
}

// Tutup koneksi ke database
mysqli_close($db);
?>
