<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['konfirmasi_pembayaran'])) {
    $id_pemesanan_na = $_POST['id_pemesanan_na'];

    // Update status_na menjadi "terverifikasi"
    $query = "UPDATE pemesanan_na SET status_na = 'terverifikasi' WHERE id_pemesanan_na = $id_pemesanan_na";

    if (mysqli_query($conn, $query)) {
        // echo "Pembayaran telah berhasil dikonfirmasi.";
        // Redirect kembali ke halaman pemesanan-status.php dengan parameter data=pemesanan-status
        // header("Location: pemesanan-konfirmasi.php?data=pemesanan-konfirmasi");
        header("Location: ../admin/?data=pemesanan-status");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
