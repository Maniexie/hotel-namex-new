<?php
// Include file koneksi ke database
include "../koneksi.php";

// Cek jika parameter id_pemesanan tersedia
if (isset($_POST['id_pemesanan_na'])) {
    // Ambil id_pemesanan dari parameter POST
    $id_pemesanan = $_POST['id_pemesanan_na'];

    // Query untuk menghapus pemesanan berdasarkan id_pemesanan
    $query = "DELETE FROM pemesanan_na WHERE id_pemesanan_na = ?";

    // Persiapkan statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "i", $id_pemesanan);

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil dihapus, redirect ke halaman pemesanan-status.php
        header("Location: ../admin/?data=pemesanan-status");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    // Jika parameter id_pemesanan tidak tersedia, tampilkan pesan error
    echo "ID Pemesanan tidak ditemukan.";
}

// Tutup koneksi database
mysqli_close($conn);
