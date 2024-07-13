<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_pesan'])) {
    $id_user_na = $_POST['id_user_na'];
    $id_kamar_na = $_POST['id_kamar_na'];
    $nama_na = $_POST['nama_na'];
    $email_na = $_POST['email_na'];
    $nohp_na = $_POST['nohp_na'];
    $check_in_na = $_POST['check_in_na'];
    $check_out_na = $_POST['check_out_na'];
    $status_na = $_POST['status_na'];
    $keterangan_na = $_POST['keterangan_na'];

    // Menghitung total harga
    $query = "SELECT harga_na FROM kamar_na WHERE id_kamar_na = $id_kamar_na";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $kamar = mysqli_fetch_assoc($result);
        $harga_na = $kamar['harga_na'];
        $check_in_date = new DateTime($check_in_na);
        $check_out_date = new DateTime($check_out_na);
        $interval = $check_in_date->diff($check_out_date);
        $total_harga_na = $interval->days * $harga_na;

        // Menyimpan data ke tabel pemesanan
        $query = "INSERT INTO pemesanan_na (id_user_na, id_kamar_na, nama_na, email_na, nohp_na, check_in_na, check_out_na, total_harga_na, status_na, keterangan_na)
                  VALUES ('$id_user_na','$id_kamar_na', '$nama_na', '$email_na', '$nohp_na', '$check_in_na', '$check_out_na', '$total_harga_na','pending', '$keterangan_na')";
        if (mysqli_query($conn, $query)) {
            echo "Pemesanan berhasil disimpan.";
            // header('location : proses/proses_pembayaran.php');
            header("Location: proses_pembayaran.php?id_pemesanan_na=" . mysqli_insert_id($conn));
        } else {
            // echo "Error: " . mysqli_error($conn);
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Kamar tidak ditemukan.";
    }
} else {
    echo "Invalid request.";
}
