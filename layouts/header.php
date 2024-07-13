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
        <h1 class="logo"><a href="index.php">namex</a></h1>    
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




    <!-- End #main -->