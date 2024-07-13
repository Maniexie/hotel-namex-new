<?php
session_start();

include "koneksi.php";
$query = "SELECT * FROM kamar_na";
$tampil = mysqli_query($conn, $query);

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
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

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
            <!-- <h1 class="logo"><a href="index.html">Butterfly</a></h1> -->
            <h1 class="logo"><a href="index.php">namex</a></h1>    

            <nav id="navbar" class="navbar">
                <ul>

                    <?php if (!isset($_SESSION['id_na'])) : ?>
                        <li><a class="" href="login.php">Log In</a></li>
                    <?php else : ?>
                        <li class="dropdown"><a href="#"><span><?php echo $_SESSION['role_na']; ?></span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="profile.php">Profil</a></li>
                                <li><a href="pemesanan.php">Pemesanan</a></li>
                                <li><a href="#">Settings</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </li>

                    <?php endif; ?>

                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Hotel Namex Premiere pekanbaru</h1>
                    <h2>Namex Premiere Pekanbaru berlokasi strategis di antara gedung pemerintahan dan perkantoran besar, di samping RTH Kaca Mayang, dan hanya 15 menit dari Bandara Internasional Sultan Syarif Kasim II. ZHM Premiere Pekanbaru memiliki 168 kamar dan suite, 11 ruang pertemuan dan 1 ballroom, gedung parkir eksklusif, dan fasilitas lainnya.</h2>
                    <!-- <div><a href="#about" class="btn-get-started scrollto">Get Started</a></div> -->
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets/img/hotel.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Hotel</h2>
                    <p>"Selamat datang di Hotel Namex, tempat di mana kenyamanan dan kemewahan berpadu sempurna. Kami berharap Anda menikmati setiap momen menginap di sini."</p>
                </div>

                <div class="row">
                    <?php
                    $no = 1;
                    while ($r = mysqli_fetch_array($tampil)) {
                    ?>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                            <div class="member">
                                <div class="member-img">
                                    <img src="admin/img/<?php echo "$r[gambar_na]"; ?>" class="img-fluid " alt="" style="width:300px ; height:300px">
                                </div>
                                <div class="member-info">
                                    <h4><?php echo "$r[jenis_kamar_na]"; ?></h4>
                                    <span>Kapasitas :<?php echo "$r[kapasitas_na]"; ?></span>
                                    <span>Harga :<?php echo "$r[harga_na]"; ?>/kamar/malam</span>
                                    <?php if (!isset($_SESSION['id_na'])) : ?>
                                        <a href="login.php" type="button" class="btn btn-primary mt-2">Pesan</a>
                                    <?php else : ?>
                                        <a href="pesan.php?kamar=<?php echo "$r[id_kamar_na]"; ?>" type="button" class="btn btn-primary mt-2">
                                            Pesan
                                        </a>


                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- Vertically centered Modal -->

        </section><!-- End Team Section -->




    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">


        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Butterfly</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/butterfly-free-bootstrap-theme/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

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