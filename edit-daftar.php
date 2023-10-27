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

$nim = "";
$nama = "";
$alamat = "";
$jenis_kelamin = "";
$prodi = "";
$fakultas = "";
$agama = "";

if (isset($_GET["nim"])) {
    $nim = $_GET["nim"];

    $query = "SELECT * FROM daftar_ukm WHERE nim = '$nim'";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($db));
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nim = $row['nim'];
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $prodi = $row['jurusan']; 
        $fakultas = $row['fakultas'];
        $agama = $row['agama'];
        $ukm = $row['ukm'];
    } else {
        echo "Data tidak ditemukan.";
    }
}

if (isset($_POST['update'])) {
    $newNim = $_POST['nim'];
    $newNama = $_POST['nama'];
    $newAlamat = $_POST['alamat'];
    $newJenisKelamin = $_POST['jenis_kelamin'];
    $newProdi = $_POST['prodi']; // Memperbarui $newProdi menjadi $_POST['prodi']
    $newFakultas = $_POST['fakultas'];
    $newAgama = $_POST['agama'];
    $newUkm = $_POST['ukm'];

    $updateQuery = "UPDATE daftar_ukm SET nim = '$newNim', nama = '$newNama', alamat = '$newAlamat', jenis_kelamin = '$newJenisKelamin', jurusan = '$newProdi', fakultas = '$newFakultas', agama = '$newAgama', ukm = '$newUkm' WHERE nim = '$nim'";
    $updateResult = mysqli_query($db, $updateQuery);

    if (!$updateResult) {
        die("Update gagal: " . mysqli_error($db));
    } else {
        $_SESSION['update_message'] = "Update berhasil";
        header("Location: list-pendaftar.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pendaftar</title>
    <!-- Tambahkan link ke CSS Bootstrap di sini -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Edit Data Pendaftar</h2>
        <form method="post" action="" class="mt-3">
            <input type="hidden" name="nim" value="<?php echo $nim; ?>">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="laki-laki" name="jenis_kelamin" value="Laki-laki" <?php if ($jenis_kelamin == "Laki-laki") echo "checked"; ?>>
                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="perempuan" name="jenis_kelamin" value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo "checked"; ?>>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>

            <div class="form-group">
                <label for="fakultas">Fakultas:</label>
                <select class="form-control" id="fakultas" name="fakultas">
                    <option value="fakultas_ilmu_komputer" <?php if ($fakultas == "fakultas_ilmu_komputer") echo "selected"; ?>>Fakultas Ilmu Komputer</option>
                    <option value="fakultas_ekonomi_dan_sosial" <?php if ($fakultas == "fakultas_ekonomi_dan_sosial") echo "selected"; ?>>Fakultas Ekonomi dan Sosial</option>
                    <option value="fakultas_sains_dan_teknologi" <?php if ($fakultas == "fakultas_sains_dan_teknologi") echo "selected"; ?>>Fakultas Sains dan Teknologi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <select class="form-control" id="prodi" name="prodi">
                    <!-- Opsi prodi akan diisi melalui JavaScript -->
                </select>
            </div>
            <div class="form-group">
    <label for="ukm">Pilihan UKM :</label>
    <select class="form-control" id="ukm" name="ukm">
        <option value="Senat Mahasiswa">Senat Mahasiswa</option>
        <option value="Badan Eksekutif Mahasiswa (BEM)">Badan Eksekutif Mahasiswa (BEM)</option>
        <option value="Himpunan Mahasiswa Informatika (HMIF)">Himpunan Mahasiswa Informatika (HMIF)</option>
        <option value="Himpunan Mahasiswa Sistem Informasi (HIMASI)">Himpunan Mahasiswa Sistem Informasi (HIMASI)</option>
        <option value="Himpunan Mahasiswa Manajemen Informatika (HIMMI)">Himpunan Mahasiswa Manajemen Informatika (HIMMI)</option>
        <option value="Amikom Komputer Club (AMCC)">Amikom Komputer Club (AMCC)</option>
        <option value="Komunitas Multimedia Amikom (KOMA)">Komunitas Multimedia Amikom (KOMA)</option>
        <option value="Amikom English Club (AEC)">Amikom English Club (AEC)</option>
        <option value="Free Open Source Software Interst League (FOSSIL)">Free Open Source Software Interst League (FOSSIL)</option>
        <option value="Lembaga Pers Mahasiswa (LPM)">Lembaga Pers Mahasiswa (LPM)</option>
        <option value="Himpunan Mahasiswa Ilmu Komunikasi Amikom (HIMIKA)">Himpunan Mahasiswa Ilmu Komunikasi Amikom (HIMIKA)</option>
        <option value="Himpunan Mahasiswa Ilmu Pemerintahan (HIMIP)">Himpunan Mahasiswa Ilmu Pemerintahan (HIMIP)</option>
        <option value="Korps Mahasiswa Hubungan Internasional (KOMAHI)">Korps Mahasiswa Hubungan Internasional (KOMAHI)</option>
        <option value="Himpunan Mahasiswa D3 INFORMATIKA (HIMADITI)">Himpunan Mahasiswa D3 INFORMATIKA (HIMADITI)</option>
    </select>
</div>
            <div class="form-group">
                <label for="agama">Agama:</label>
                <select class="form-control" id="agama" name="agama">
                    <option value="Islam" <?php if ($agama == "Islam") echo "selected"; ?>>Islam</option>
                    <option value="Katolik" <?php if ($agama == "Katolik") echo "selected"; ?>>Katolik</option>
                    <option value="Kristen" <?php if ($agama == "Kristen") echo "selected"; ?>>Kristen</option>
                    <option value="Hindu" <?php if ($agama == "Hindu") echo "selected"; ?>>Hindu</option>
                    <option value="Buddha" <?php if ($agama == "Buddha") echo "selected"; ?>>Buddha</option>
                    <option value="Konghucu" <?php if ($agama == "Konghucu") echo "selected"; ?>>Konghucu</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="update" onclick="return konfirmasiEdit()">Update Data</button>
        </form>
        <a href="list-pendaftar.php" class="btn btn-secondary mt-3">Kembali ke Daftar Pendaftar</a>
    </div>

    
</body>
</html>

<script>
    function konfirmasiEdit() {
        var konfirmasi = window.confirm("Apakah Anda yakin ingin Mengedit data tersebut?");
        if (konfirmasi) {
            // Jika pengguna yakin, arahkan ke halaman logout
           
            return true;
        } else {
            // Jika pengguna membatalkan logout, tampilkan pesan dan tetap di halaman saat ini
            alert("Edit dibatalkan.");
            return false;
        }
    }
</script>

<script>
    function updateJurusan() {
        const fakultasSelect = document.getElementById("fakultas");
        const prodiSelect = document.getElementById("prodi");

        prodiSelect.innerHTML = "";
        const selectedFakultas = fakultasSelect.value;

        if (selectedFakultas === "fakultas_ilmu_komputer") {
            const options = [
                "Informatika",
                "Manajemen Informatika",
                "Sistem Informasi"
            ];

            options.forEach(option => {
                const optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;
                prodiSelect.appendChild(optionElement);
            });
        } else if (selectedFakultas === "fakultas_ekonomi_dan_sosial") {
            const options = [
                "Ilmu Komunikasi",
                "Akuntansi",
                "Hubungan Internasional"
            ];

            options.forEach(option => {
                const optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;
                prodiSelect.appendChild(optionElement);
            });
        } else if (selectedFakultas === "fakultas_sains_dan_teknologi") {
            const options = [
                "Geografi",
                "Arsitektur",
                "Perencanaan Wilayah dan Kota"
            ];

            options.forEach(option => {
                const optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;
                prodiSelect.appendChild(optionElement);
            });
        }
    }

   
    updateJurusan();    

    
    document.getElementById("fakultas").addEventListener("change", updateJurusan);
</script>
