<?php
include("config.php");

if(isset($_POST['daftar'])){
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $ukm = $_POST['ukm'];

    $foto_name = $_FILES['foto']['name'];
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_folder = "uploads/"; 
    $uploadfile = $foto_folder.$foto_name;

    if(move_uploaded_file($foto_temp, $foto_folder . $foto_name)){
        echo "Nama File : <b>$foto_name</b> sukses di upload";
        $sql = "INSERT INTO daftar_ukm (nim, nama, alamat, jenis_kelamin, agama, fakultas, jurusan, ukm, user_foto) VALUES ('$nim', '$nama', '$alamat', '$jk', '$agama', '$fakultas', '$jurusan', '$ukm', '$foto_name')";
        $query = mysqli_query($db, $sql);

        if($query) {
            header('Location: index.php?status=sukses');
        } else {
            header('Location: index.php?status=gagal');
        }
    } else {
        echo "Unggahan gambar gagal.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran UKM</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <header>
                <h3 class="card-title">Formulir Pendaftaran UKM</h3>
            </header>

            <form action="" method="POST" enctype="multipart/form-data">

                <fieldset>

                <div class="form-group">
                    <label for="nama">Nama Lengkap :</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="nim">NIM:</label>
                    <input type="text" class="form-control" name="nim" placeholder="Masukan NIM">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" name="alamat"></textarea>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" id="laki-laki">
                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" id="perempuan">
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
    <label for="foto">Foto (JPEG/PNG):</label>
    <input type="file" class="form-control-file" name="foto" id="foto">
</div>
                <div class="form-group">
                    <label for="fakultas">Fakultas:</label>
                    <select class="form-control" id="fakultas" name="fakultas" onchange="updateJurusan()">
                        <option value="fakultas_ilmu_komputer">Fakultas Ilmu Komputer</option>
                        <option value="fakultas_ekonomi_dan_sosial">Fakultas Ekonomi dan Sosial</option>
                        <option value="fakultas_sains_dan_teknologi">Fakultas Sains dan Teknologi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ukm">Pilihan UKM :</label>
                    <select class="form-control" name="ukm" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                        <option>Senat Mahasiswa</option>
                        <option>Badan Eksekutif Mahasiswa (BEM) </option>
                        <option>Himpunan Mahasiswa Informatika (HMIF)</option>
                        <option>Himpunan Mahasiswa Sistem Informasi (HIMASI) </option>
                        <option>Himpunan Mahasiswa Manajemen Informatika (HIMMI)</option>
                        <option>Amikom Komputer Club (AMCC)</option>
                        <option>Komunitas Multimedia Amikom (KOMA) </option>
                        <option>Amikom English Club (AEC)</option>
                        <option>Free Open Source Software Interst League (FOSSIL) </option>
                        <option>Lembaga Pers Mahasiswa (LPM)</option>
                        <option>Himpunan Mahasiswa Ilmu Komunikasi Amikom (HIMIKA)</option>
                        <option>Himpunan Mahasiswa Ilmu Pemerintahan (HIMIP)</option>
                        <option>Korps Mahasiswa Hubungan Internasional (KOMAHI)</option>
                        <option>Himpunan Mahasiswa D3 INFORMATIKA (HIMADITI)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fakultas">Jurusan:</label>
                    <select class="form-control" id="jurusan" name="jurusan">
                    
                    </select>
                </div>
                <div class="form-group">
                    <label for="agama">Agama:</label>
                    <select class="form-control" name="agama">
                        <option>Islam</option>
                        <option>Katolik</option>
                        <option>Kristen</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Konghucu</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Daftar" name="daftar" />
                </div>

                </fieldset>

            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function updateJurusan () {
        const fakultasSelect = document.getElementById("fakultas");
        const jurusanSelect = document.getElementById("jurusan");

        jurusanSelect.innerHTML = "";
        const selectedFakultas = fakultasSelect.value;
        if (selectedFakultas === "fakultas_ilmu_komputer") {

            const option1 = document.createElement("option");
            option1.value = "informatika";
            option1.textContent = "Informatika";
            jurusanSelect.appendChild(option1);

            const option2 = document.createElement("option");
            option2.value = "manajemen_informatika";
            option2.textContent = "Manajemen Informatika";
            jurusanSelect.appendChild(option2);

            const option3 = document.createElement("option");
            option3.value = "sistem_informasi";
            option3.textContent = "Sistem Informasi";
            jurusanSelect.appendChild(option3);
        } else if (selectedFakultas === "fakultas_ekonomi_dan_sosial") {
            const option1 = document.createElement("option");
            option1.value = "ilmu_komunikasi";
            option1.textContent = "Ilmu Komunikasi";
            jurusanSelect.appendChild(option1);

            const option2 = document.createElement("option");
            option2.value = "akuntansi";
            option2.textContent = "Akuntansi";
            jurusanSelect.appendChild(option2);

            const option3 = document.createElement("option");
            option3.value = "hubungan_internasional";
            option3.textContent = "Hubungan Internasional";
            jurusanSelect.appendChild(option3);
        } else if (selectedFakultas === "fakultas_sains_dan_teknologi") {
            const option1 = document.createElement("option");
            option1.value = "geografi";
            option1.textContent = "Geografi";
            jurusanSelect.appendChild(option1);

            const option2 = document.createElement("option");
            option2.value = "arsitektur";
            option2.textContent = "Arsitektur";
            jurusanSelect.appendChild(option2);

            const option3 = document.createElement("option");
            option3.value = "perencanaan_wilayah_dan_kota";
            option3.textContent = "Perencanaan Wilayah dan Kota";
            jurusanSelect.appendChild(option3);
        }
      
    }

   
    updateJurusan();
</script>
</body>
</html>
