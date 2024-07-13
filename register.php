<?php
session_start();
include('koneksi.php');

if (isset($_POST['register'])) {
    $email_na = $_POST['email_na'];
    $password_na = $_POST['password_na'];
    $nama_na = $_POST['nama_na'];
    $no_hp_na = $_POST['no_hp_na'];
    $alamat_na = $_POST['alamat_na'];
    $role_na = $_POST['role_na'];

    // Upload foto
    $foto_na = $_FILES['foto_na']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto_na);
    move_uploaded_file($_FILES['foto_na']['tmp_name'], $target_file);

    // Validasi sederhana
    if (empty($email_na) || empty($password_na) || empty($nama_na) || empty($no_hp_na) || empty($alamat_na) || empty($foto_na)) {
        $error = "All fields are required.";
    } else {
        // Hash password
        $hashed_password = password_hash($password_na, PASSWORD_DEFAULT);

        // Periksa apakah email sudah digunakan
        $query = "SELECT * FROM user_na WHERE email_na = '$email_na'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $error = "Email already in use.";
        } else {
            // Insert data ke database
            $query = "INSERT INTO user_na (email_na, password_na, nama_na, no_hp_na, alamat_na, foto_na, role_na) VALUES ('$email_na', '$hashed_password', '$nama_na', '$no_hp_na', '$alamat_na', '$foto_na', '$role_na')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['success'] = "Registration successful.";
                header('Location: login.php');
                exit();
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="admin/assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
</head>

<body>

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <!-- <img src="admin/assets/img/logo.png" alt=""> -->
                                    <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <?php if (isset($error)) echo "<p>$error</p>"; ?>
                                    <?php if (isset($_SESSION['success'])) {
                                        echo "<p>" . $_SESSION['success'] . "</p>";
                                        unset($_SESSION['success']);
                                    } ?>
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Register Account</h5>
                                        <!-- <p class="text-center small">Enter your username & password to login</p> -->
                                    </div>
                                    <form action="register.php" method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                                        <input type="hidden" name="role_na" class="form-control" id="email_register" value="user" required>
                                        <div class="col-12">
                                            <label for="email_register" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="email_na" class="form-control" id="email_register" required>
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="nama_register" class="form-label">Nama</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="nama_na" class="form-control" id="nama_register" required>
                                                <div class="invalid-feedback">Please enter your name.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password_register" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <input type="password" name="password_na" class="form-control" id="password_register" required>
                                                <div class="invalid-feedback">Please enter your password.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="no_hp_register" class="form-label">Nomor HP</label>
                                            <input type="text" name="no_hp_na" class="form-control" id="no_hp_register" required>
                                            <div class="invalid-feedback">Please enter your phone number!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="foto_register" class="form-label">Foto</label>
                                            <input type="file" name="foto_na" class="form-control" id="foto_register" required>
                                            <div class="invalid-feedback">Please upload your photo!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="alamat_register" class="form-label">Alamat</label>
                                            <textarea type="text" name="alamat_na" class="form-control" id="alamat_register" required></textarea>
                                            <div class="invalid-feedback">Please enter your address!</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" name="register">Register</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Do You have account? <a href="login.php">Log In</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="credits">
                                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="admin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="admin/assets/vendor/quill/quill.js"></script>
    <script src="admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="admin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="admin/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>