<?php include 'layouts/header.php' ?>
<?php include 'layouts/sidebar.php' ?>




<main id="main" class="main">

    <!-- <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <?php if (isset($_GET['data'])) {
                if ($_GET['data'] == 'home') {
                    include 'home.php';
                } elseif ($_GET['data'] == 'user-tambah') {
                    include 'user-tambah.php';
                } elseif ($_GET['data'] ==  'user-edit' && isset($_GET['id_na'])) {
                    include 'user-edit.php';
                } elseif ($_GET['data'] == 'user-hapus' && isset($_GET['id_na'])) {
                    include 'user-hapus.php';
                } elseif ($_GET['data'] == 'user') {
                    include 'user.php';
                } elseif ($_GET['data'] == 'kamar-data') {
                    include 'kamar-data.php';
                } elseif ($_GET['data'] == 'kamar-tambah') {
                    include 'kamar-tambah.php';
                } elseif ($_GET['data'] == 'kamar-edit' && isset($_GET['id_kamar_na'])) {
                    include 'kamar-edit.php';
                } elseif ($_GET['data'] == 'kamar-hapus' && isset($_GET['id_kamar_na'])) {
                    include 'kamar-hapus.php';
                } elseif ($_GET['data'] == 'hotel') {
                    include 'hotel.php';
                } elseif ($_GET['data'] == 'kamar-status') {
                    include 'kamar-status.php';
                } elseif ($_GET['data'] == 'pemesanan-status') {
                    include 'pemesanan-status.php';
                } elseif ($_GET['data'] == 'pemesanan-konfirmasi') {
                    include 'pemesanan-status.php';
                }
            } else {
                include 'home.php';
            }
            ?>



        </div>
    </section>

</main><!-- End #main -->

<?php include 'layouts/footer.php' ?>