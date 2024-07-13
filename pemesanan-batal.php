<?php
session_start();
include 'koneksi.php';

// Cek apakah pengguna sudah login dan memiliki peran yang benar
if (!isset($_SESSION['id_na']) || ($_SESSION['role_na'] != 'admin' && $_SESSION['role_na'] != 'user')) {
    header("Location: login.php");
    exit;
}

// Cek apakah ID pemesanan tersedia di POST request
if (isset($_POST['id_pemesanan_na'])) {
    $id_pemesanan_na = $_POST['id_pemesanan_na'];

    // Query untuk mengupdate status pemesanan menjadi 'dibatalkan'
    $query = "UPDATE pemesanan_na SET status_na = 'dibatalkan' WHERE id_pemesanan_na = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_pemesanan_na);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman daftar pemesanan dengan pesan sukses
        $_SESSION['message'] = "Pemesanan berhasil dibatalkan.";
        header("Location: pemesanan.php");
    } else {
        // Redirect kembali ke halaman daftar pemesanan dengan pesan kesalahan
        $_SESSION['message'] = "Gagal membatalkan pemesanan.";
        header("Location: pemesanan.php");
    }

    $stmt->close();
} else {
    // Redirect jika tidak ada ID pemesanan di POST request
    $_SESSION['message'] = "ID pemesanan tidak ditemukan.";
    header("Location: pemesanan.php");
}

$conn->close();
