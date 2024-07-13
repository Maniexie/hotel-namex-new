<?php
include('koneksi.php');

$email_na = 'user@gmail.com';
$nama_na = 'user';
$password_na = 'user';
$no_hp_na = '123';
$foto_na = 'kosong.png';
$alamat_na = 'alamat.png';
$hashed_password = password_hash($password_na, PASSWORD_DEFAULT);

$query = "INSERT INTO user_na (email_na, nama_na, password_na, no_hp_na, foto_na, alamat_na, role_na) VALUES ('$email_na', '$nama_na','$hashed_password','$no_hp_na','$foto_na','alamat_na','user')";
mysqli_query($conn, $query);
