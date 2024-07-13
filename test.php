<?php
session_start();
include "../koneksi.php";

$id_pemesanan_na = $_GET['id_pemesanan_na'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file_name = $_FILES['bukti_pembayaran_na']['name'];
    $file_tmp = $_FILES['bukti_pembayaran_na']['tmp_name'];
    $file_ext_array = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext_array));
    $extensions = array("jpeg", "jpg", "png", "pdf");
    $errors = array();

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Extension not allowed, please choose a JPEG, JPG, PNG, or PDF file.";
    }

    if (empty($errors)) {
        // Pastikan direktori uploads ada
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        // Generate a unique file name to avoid conflicts
        $new_file_name = uniqid() . '.' . $file_ext;

        if (move_uploaded_file($file_tmp, "uploads/" . $new_file_name)) {
            $query = "UPDATE pemesanan_na SET bukti_pembayaran_na = '$new_file_name', status_na = 'menunggu verifikasi' WHERE id_pemesanan_na = $id_pemesanan_na";
            if (mysqli_query($conn, $query)) {
                echo "Bukti pembayaran berhasil diunggah.";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Upload Bukti Pembayaran</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <main id="main">
        <section id="about" class="about">
            <div class="container">
                <h4 class="mt-5 text-center">Upload Bukti Pembayaran</h4>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <form action="proses_pembayaran.php?id_pemesanan_na=<?php echo $id_pemesanan_na; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Unggah Bukti Pembayaran</label>
                                <input class="form-control" type="file" id="formFile" name="bukti_pembayaran_na" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Unggah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>