<?php
session_start();
include "../koneksi.php";



if (!isset($_SESSION['id_na']) || ($_SESSION['role_na'] != 'admin' && $_SESSION['role_na'] != 'staff' && $_SESSION['role_na'] != 'user')) {
    header("Location: login.php");
    exit;
}




$id_kamar = isset($_GET['nama_pemesan_na']) ? $_GET['nama_pemesan_na'] : 0;

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
                // echo "Bukti pembayaran berhasil diunggah.";
                echo "
               <script>
                     alert('Berhasil Upload Bukti Pembayaran');
                        window.location.href = '../pemesanan.php';
                    </script>
               ";
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

    <title>Hotel NA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo"><a href="../index.php">namex</a></h1>    
            <!-- <a href="index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
            <!-- Uncomment below if you prefer to use text as a logo -->
            <!-- <h1 class="logo"><a href="index.php">namex</a></h1>    -->


            <nav id="navbar" class="navbar">
                <ul>
                    <?php if (!isset($_SESSION['id_na'])) : ?>
                        <li><a class="" href="login.php">Log In</a></li>
                    <?php else : ?>
                        <li class="dropdown"><a href="#"><span><?php echo $_SESSION['role_na']; ?></span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="pemesanan.php">Pemesanan</a></li>
                                <li><a href="#">Settings</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </li>

                    <?php endif; ?>

                </ul>
            </nav><!-- .navbar -->

        </div>
    </header>

    <!-- End Header -->

    <main id="main">
        <section id="about" class="about">
            <div class="container">
                <h4 class="mt-5 text-center">Upload Bukti Pembayaran</h4>
                <div class="row mt-5">
                    <div class="col-lg-6">
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


    <!-- ======= Footer ======= -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>