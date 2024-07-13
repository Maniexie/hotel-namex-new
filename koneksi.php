<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "hotel_na";


$conn = new mysqli($server, $username, $password, $database);

/* ===== USER ====== */

function tambahdatauser($data)
{
    global $conn;
    $email_na = htmlspecialchars($data['email_na']);
    $nama_na = htmlspecialchars($data['nama_na']);
    $password_na = htmlspecialchars($data['password_na']);
    $no_hp_na = htmlspecialchars($data['no_hp_na']);
    $alamat_na = htmlspecialchars($data['alamat_na']);
    $role_na = htmlspecialchars($data['role_na']);

    $foto_na = uploadfotouser();
    if (!$foto_na) {
        $foto_na = 'kosong.png';
    }
    $user = "INSERT INTO user_na VALUES ('','$email_na','$nama_na','$password_na','$no_hp_na','$foto_na','$alamat_na','$role_na')";
    mysqli_query($conn, $user);
}

function uploadfotouser()
{
    $namefile = $_FILES['foto_na']['name'];
    $tmpfile = $_FILES['foto_na']['tmp_name'];
    $sizefile = $_FILES['foto_na']['size'];
    $errorfile = $_FILES['foto_na']['error'];

    if ($errorfile === 4) {
        // Jika tidak ada file yang diunggah, kembalikan false
        return false;
    }

    // cek apakah gambar ektensi (jpg , jpeg , png) yang di upload 
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namefile, PATHINFO_EXTENSION));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
?>
        <script>
            alert('file yang di upload bukan gambar');
            window.location.href = 'index.php';
        </script>
    <?php
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($sizefile > 1000000) {
    ?>
        <script>
            alert('ukuran file gambar terlalu besar !!');
            window.location.href = 'index.php';
        </script>
    <?php
        return false;
    }

    // jika pengecekan lolos maka gambar siap di upload 
    $namafilebaru = uniqid() . '.' . $ekstensiGambar;

    if (move_uploaded_file($tmpfile, './img/' . $namafilebaru)) {
        return $namafilebaru;
    } else {
    ?>
        <script>
            alert('Gagal mengunggah file.');
            window.location.href = 'index.php';
        </script>
    <?php
        return false;
    }
}

function hapusdatauser($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM user_na WHERE id_na = $id");
}


function editdatauser($data)
{
    global $conn;
    $id_na = htmlspecialchars($data["id_na"]);
    $email_na = htmlspecialchars($data['email_na']);
    $nama_na = htmlspecialchars($data['nama_na']);
    $no_hp_na = htmlspecialchars($data['no_hp_na']);
    $alamat_na = htmlspecialchars($data['alamat_na']);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['foto_na']['error'] === 4) {
        $foto_na = $gambarLama;
    } else {
        $foto_na = uploadfotouser();
        if (!$foto_na) {
            return -1;
        }
        if ($gambarLama != '') {
            unlink('./img/' . $gambarLama);
        }
    }

    $query = "UPDATE user_na SET email_na='$email_na', nama_na='$nama_na', no_hp_na='$no_hp_na', foto_na='$foto_na', alamat_na='$alamat_na' WHERE id_na=$id_na";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

/* ===== END USER ====== */



/* ===== USER ====== */


function tambahdatakamar($data)
{
    global $conn;
    // $gambar_na = htmlspecialchars($data['gambar_na']);
    $jenis_kamar_na = htmlspecialchars($data['jenis_kamar_na']);
    $kapasitas_na = htmlspecialchars($data['kapasitas_na']);
    $harga_na = htmlspecialchars($data['harga_na']);


    $gambar_na = uploadgambarkamar();
    if (!$gambar_na) {
        $gambar_na = 'kosongkamar.png';
    }
    $query = "INSERT INTO kamar_na VALUES ('','$gambar_na','$jenis_kamar_na','$kapasitas_na','$harga_na')";
    mysqli_query($conn, $query);
}


function uploadgambarkamar()
{
    $namefile = $_FILES['gambar_na']['name'];
    $tmpfile = $_FILES['gambar_na']['tmp_name'];
    $sizefile = $_FILES['gambar_na']['size'];
    $errorfile = $_FILES['gambar_na']['error'];

    if ($errorfile === 4) {
        // Jika tidak ada file yang diunggah, kembalikan false
        return false;
    }

    // cek apakah gambar ektensi (jpg , jpeg , png) yang di upload 
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namefile, PATHINFO_EXTENSION));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    ?>
        <script>
            alert('file yang di upload bukan gambar');
            window.location.href = '?data=kamar-data';
        </script>
    <?php
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($sizefile > 1000000) {
    ?>
        <script>
            alert('ukuran file gambar terlalu besar !!');
            window.location.href = '?data=kamar-data';
        </script>
    <?php
        return false;
    }

    // jika pengecekan lolos maka gambar siap di upload 
    $namafilebaru = uniqid() . '.' . $ekstensiGambar;

    if (move_uploaded_file($tmpfile, './img/' . $namafilebaru)) {
        return $namafilebaru;
    } else {
    ?>
        <script>
            alert('Gagal mengunggah file.');
            window.location.href = 'index.php';
        </script>
<?php
        return false;
    }
}


function editdatakamar($data)
{
    global $conn;
    $id_kamar_na = htmlspecialchars($data["id_kamar_na"]);
    $jenis_kamar_na = htmlspecialchars($data['jenis_kamar_na']);
    $kapasitas_na = htmlspecialchars($data['kapasitas_na']);
    $harga_na = htmlspecialchars($data["harga_na"]);
    $gambarLamaKamar = htmlspecialchars($data["gambarLamaKamar"]);

    // Handling upload gambar baru atau tetap menggunakan gambar lama
    if ($_FILES['gambar_na']['error'] === 4) {
        // Jika tidak ada file baru diunggah
        $gambar_na = $gambarLamaKamar;
    } else {
        // Jika ada file baru diunggah
        $gambar_na = uploadgambarkamar();
        if ($gambar_na === false) {
            return -1; // Gagal upload gambar baru
        }
        if ($gambarLamaKamar != '') {
            // Hapus gambar lama jika berhasil diupload yang baru
            unlink('./img/' . $gambarLamaKamar);
        }
    }


    // Query untuk update data kamar
    $query = "UPDATE kamar_na SET gambar_na='$gambar_na', jenis_kamar_na='$jenis_kamar_na', kapasitas_na='$kapasitas_na', harga_na='$harga_na' WHERE id_kamar_na=$id_kamar_na";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function hapusdatakamar($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kamar_na WHERE id_kamar_na = $id");
}



function formatRupiah($angka)
{
    return 'Rp' . number_format($angka, 0, ',', '.');
}
