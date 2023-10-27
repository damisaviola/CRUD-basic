<?php
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

    // Query SQL untuk menghapus data pendaftar berdasarkan NIM
    $query = "DELETE FROM daftar_ukm WHERE nim = '$nim'";

    // Eksekusi query DELETE
    $result = mysqli_query($db, $query);

    if ($result) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman daftar-pendaftar dengan pesan sukses
        header("Location: list-pendaftar.php?status=hapus_sukses&nim=$nim");
        exit();
    } else {
        // Jika penghapusan gagal, arahkan kembali ke halaman daftar-pendaftar dengan pesan kesalahan
        header("Location: list-pendaftar.php?status=hapus_gagal&nim=$nim");
        exit();
    }
} else {
    // Jika parameter "nim" tidak diberikan dalam URL, arahkan kembali ke halaman daftar-pendaftar
    header("Location: list-pendaftar.php");
    exit();
}

// Tutup koneksi ke database
mysqli_close($db);
?>
