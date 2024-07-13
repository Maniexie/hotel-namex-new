<?php
session_start();

if (!isset($_SESSION['id_na']) || ($_SESSION['role_na'] != 'admin' && $_SESSION['role_na'] != 'staff' && $_SESSION['role_na'] != 'user')) {
    header("Location: login.php");
    exit;
}

include "koneksi.php";
$query = "SELECT * FROM kamar_na";
$tampil = mysqli_query($conn, $query);

?>
<?php
// $harga_na = mysqli_query($conn, "SELECT * FROM kamar_na WHERE harga_na = '$harga_na'");
$id_kamar = isset($_GET['kamar']) ? $_GET['kamar'] : 0;
$query = "SELECT harga_na FROM kamar_na WHERE id_kamar_na = $id_kamar";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $kamar = mysqli_fetch_assoc($result);
    $harga_na = $kamar['harga_na'];
} else {
    $harga_na = 0; // Default value if kamar not found
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pesan | Namex</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- =======================================================
  * Template Name: Butterfly
  * Template URL: https://bootstrapmade.com/butterfly-free-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
            <!-- Uncomment below if you prefer to use text as a logo -->
            <h1 class="logo"><a href="index.php">namex</a></h1>    

            <nav id="navbar" class="navbar">
                <ul>
                    <li class="dropdown"><a href="#"><span><?php echo $_SESSION['role_na']; ?></span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Profile</a></li>
                            <li><a href="pemesanan.php">Pemesanan</a></li>
                            <li><a href="#">Settings</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->


    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <h4 class="mt-5 text-center">Data Pemesanan Kamar</h4>
                <div class="row mt-5">
                    <div class="col-xl-5 col-lg-6 d-flex justify-content-center video-bo align-items-stretch position-relative">
                        <?php
                        if (isset($_GET['kamar'])) {
                            $id_kamar = $_GET['kamar'];
                            $query = "SELECT * FROM kamar_na WHERE id_kamar_na = $id_kamar";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                $kamar = mysqli_fetch_assoc($result);
                        ?>
                                <div>
                                    <img src="admin/img/<?php echo $kamar['gambar_na']; ?>" alt="Gambar Kamar" style="max-width: 300px;" class="img-fluid img-thumbnail">
                                    <h4><?php echo $kamar['jenis_kamar_na']; ?></h4>
                                    <p>Kapasitas: <?php echo $kamar['kapasitas_na']; ?></p>
                                    <p>Harga: <?php echo formatRupiah($kamar['harga_na']); ?>/kamar/malam</p>

                                </div>
                        <?php
                            } else {
                                echo "Kamar tidak ditemukan.";
                            }
                        } else {
                            echo "Parameter kamar tidak ditemukan.";
                        }
                        ?>
                    </div>
                    <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-2 px-lg-5">
                        <!-- General Form Elements -->
                        <form action="proses/proses_pemesanan.php" method="POST">
                            <input type="hidden" name="id_kamar_na" value="<?php echo $id_kamar; ?>">
                            <input type="hidden" name="id_user_na" value="<?php echo $_SESSION['id_na']; ?>">
                            <input type="hidden" name="status_na" value="<?php htmlspecialchars('pending'); ?>">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_na" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email_na" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nomor HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nohp_na" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="check_in_na" class="col-sm-2 col-form-label">Check In</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="check_in_na" id="check_in_na" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="check_out_na" class="col-sm-2 col-form-label">Check Out</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="check_out_na" id="check_out_na" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="total_harga_na" class="col-sm-2 col-form-label">Total Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="total_harga_na" id="total_harga_na" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px" name="keterangan_na"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" style="float:right" name="submit_pesan">Submit Form</button>
                                </div>
                            </div>
                        </form>

                        <!-- End General Form Elements -->

                    </div>

                </div>

            </div>
        </section><!-- End About Section -->

    </main><!-- End #main -->

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

    <!-- Jquery #check_in_na #check_out_na -->
    <script>
        $(document).ready(function() {
            function formatRupiah(angka, prefix) {
                var numberString = angka.toString().replace(/[^,\d]/g, ''),
                    split = numberString.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // Tambahkan titik jika ada ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
            }

            function calculateTotalPrice() {
                var hargaPerMalam = <?php echo $harga_na; ?>;
                var checkInDate = new Date($('#check_in_na').val());
                var checkOutDate = new Date($('#check_out_na').val());

                if (checkInDate && checkOutDate && checkInDate < checkOutDate) {
                    var timeDifference = checkOutDate - checkInDate;
                    var daysDifference = timeDifference / (1000 * 3600 * 24);
                    var totalPrice = daysDifference * hargaPerMalam;
                    var formattedPrice = formatRupiah(totalPrice, 'Rp ');
                    $('#total_harga_na').val(formattedPrice);
                } else {
                    $('#total_harga_na').val('');
                }
            }

            $('#check_in_na, #check_out_na').on('change', calculateTotalPrice);
        });
    </script>



</body>

</html>