<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran yang benar
if (!isset($_SESSION['id_na']) || ($_SESSION['role_na'] != 'admin' && $_SESSION['role_na'] != 'staff' && $_SESSION['role_na'] != 'user')) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Ambil ID pengguna dari sesi
$id_na = $_SESSION['id_na'];

// Query untuk mengambil data pemesanan berdasarkan ID pengguna yang sedang login
$query = "SELECT * FROM pemesanan_na WHERE id_user_na = '$id_na'";
$tampil = mysqli_query($conn, $query);



function getStatusClass($status)
{
    switch ($status) {
        case 'pending':
            return 'bg-danger text-center';
        case 'menunggu verifikasi':
            return 'bg-warning';
        case 'terverifikasi':
            return 'bg-success';
        case 'proses':
            return 'bg-info';
        case 'dibatalkan':
            return 'bg-secondary';
        default:
            return 'bg-danger text-center';
    }
}

function getStatusText($status)
{
    switch ($status) {
        case 'pending':
            return 'pending';
        case 'menunggu verifikasi':
            return 'proses';
        case 'terverifikasi':
            return 'terverifikasi';
        case 'proses':
            return 'proses';
        case 'dibatalkan':
            return 'dibatalkan';
        default:
            return 'pending';
    }
}
?>



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Data Pemesanan</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="admin/assets/img/favicon.png" rel="icon">
    <link href="admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="admin/assets/css/style.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php include 'layouts/header.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <!-- Breadcrumb Content -->
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Pemesanan</h5>
                            <table class="table table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pemesan</th>
                                        <th scope="col">Email Pemesan</th>
                                        <th scope="col">Jenis Kamar</th>
                                        <th scope="col">Nomor HP</th>
                                        <th scope="col">Check In</th>
                                        <th scope="col">Check Out</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($r = mysqli_fetch_array($tampil)) {
                                    ?>
                                        <tr class="text-center">
                                            <th scope="row"><?= $no; ?></th>
                                            <td><?= $r['nama_na']; ?></td>
                                            <td><?= $r['email_na']; ?></td>
                                            <td>
                                                <!-- <?= $r['id_kamar_na']; ?> -->
                                                <?php
                                                // Misalnya, jika Anda ingin mengambil jenis_kamar_na dari tabel kamar_na
                                                $id_kamar = $r['id_kamar_na'];
                                                $query_jenis_kamar = "SELECT jenis_kamar_na FROM kamar_na WHERE id_kamar_na = '$id_kamar'";
                                                $result_jenis_kamar = mysqli_query($conn, $query_jenis_kamar);
                                                $row_jenis_kamar = mysqli_fetch_assoc($result_jenis_kamar);
                                                echo $row_jenis_kamar['jenis_kamar_na'];
                                                ?>
                                            </td>
                                            <td><?= $r['nohp_na']; ?></td>
                                            <td><?= $r['check_in_na']; ?></td>
                                            <td><?= $r['check_out_na']; ?></td>
                                            <td><?= formatRupiah($r['total_harga_na']); ?></td>
                                            <td class="<?= getStatusClass($r['status_na']); ?>"><?= getStatusText($r['status_na']); ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailPemesanan<?= $r['id_pemesanan_na']; ?>">
                                                    Detail
                                                </button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batalPemesanan<?= $r['id_pemesanan_na']; ?>">
                                                    Batal
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail Pemesanan -->
                                        <div class="modal fade" id="detailPemesanan<?= $r['id_pemesanan_na']; ?>" tabindex="-1" aria-labelledby="detailPemesananLabel<?= $r['id_pemesanan_na']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailPemesananLabel<?= $r['id_pemesanan_na']; ?>">Detail Pemesanan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Nama Pemesan:</strong> <?= $r['nama_na']; ?></p>
                                                        <p><strong>Email Pemesan:</strong> <?= $r['email_na']; ?></p>
                                                        <p><strong>ID Kamar:</strong>
                                                            <!-- <?= $r['id_kamar_na']; ?> -->
                                                            <?php
                                                            // Misalnya, jika Anda ingin mengambil jenis_kamar_na dari tabel kamar_na
                                                            $id_kamar = $r['id_kamar_na'];
                                                            $query_jenis_kamar = "SELECT jenis_kamar_na FROM kamar_na WHERE id_kamar_na = '$id_kamar'";
                                                            $result_jenis_kamar = mysqli_query($conn, $query_jenis_kamar);
                                                            $row_jenis_kamar = mysqli_fetch_assoc($result_jenis_kamar);
                                                            echo $row_jenis_kamar['jenis_kamar_na'];
                                                            ?>
                                                        </p>
                                                        <p><strong>Nomor HP:</strong> <?= $r['nohp_na']; ?></p>
                                                        <p><strong>Check In:</strong> <?= $r['check_in_na']; ?></p>
                                                        <p><strong>Check Out:</strong> <?= $r['check_out_na']; ?></p>
                                                        <p><strong>Total Harga:</strong> <?= formatRupiah($r['total_harga_na']); ?></p>
                                                        <p><strong>Bukti Pembayaran:</strong>
                                                            <?php if ($r['bukti_pembayaran_na']) { ?>
                                                                <img src="proses/uploads/<?= $r['bukti_pembayaran_na']; ?>" class="img-fluid" alt="">
                                                        <p>Status: <span class="badge bg-info">proses</span></p>
                                                    <?php } else { ?>
                                                        <form action="proses/proses_pembayaran.php?id_pemesanan_na=<?php echo $r['id_pemesanan_na']; ?>" method="POST" enctype="multipart/form-data">
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Unggah Bukti Pembayaran</label>
                                                                <input class="form-control" type="file" id="formFile" name="bukti_pembayaran_na" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Unggah</button>
                                                        </form>
                                                    <?php } ?>
                                                    </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Detail Pemesanan -->
                                        <!-- proses/proses_pembayaran.php?id_pemesanan_na=9 -->

                                        <!-- Modal Batal Pemesanan-->
                                        <div class="modal fade" id="batalPemesanan<?= $r['id_pemesanan_na']; ?>" tabindex="-1" aria-labelledby="batalPemesanan<?= $r['id_pemesanan_na']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="batalPemesanan<?= $r['id_pemesanan_na']; ?>">Konfirmasi Batalkan Pemesanan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Anda yakin ingin membatalkan pemesanan ini?</p>
                                                        <p><strong>Nama Pemesan:</strong> <?= $r['nama_na']; ?></p>
                                                        <p><strong>ID Pemesanan:</strong> <?= $r['id_pemesanan_na']; ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="pemesanan-batal.php" method="POST">
                                                            <input type="hidden" name="id_pemesanan_na" value="<?= $r['id_pemesanan_na']; ?>">
                                                            <button type="submit" name="batalkan_pemesanan" class="btn btn-danger" onclick="return confirm('Anda yakin ingin membatalkan pemesanan ini?')">Batalkan Pemesanan</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Batal Pemesanan -->

                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="admin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="admin/assets/vendor/quill/quill.js"></script>
    <script src="admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="admin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="admin/assets/vendor/php-email-form/validate.js"></script>

    <?php include 'layouts/footer.php'; ?>

</body>

</html>