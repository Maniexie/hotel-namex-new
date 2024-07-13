<div class="pagetitle">
    <h1>User</h1>
    <nav>
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>
    </nav>
</div><!-- End Page Title -->

<?php
require_once '../koneksi.php';
?>
<?php
if (isset($_POST['submit'])) {
    if (tambahdatauser($_POST) >= 0) {
        echo '';
?>
        <script>
            alert('data berhasil ditambahkan');
            window.location.href = '?data=user'
        </script>
<?php
    } else {
        echo 'data gagal di tambahkan ';
    }
}
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <!-- <button type="button" class="btn btn-primary mt-2" style="float:right">Tambah User</button> -->
            <h5 class="card-title">Tambah Data User</h5>
            <!-- <p>Add <code>.table-sm</code> to make any <code>.table</code> more compact by cutting all cell padding in half.</p> -->
            <!-- Small tables -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3 mt-2">
                                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNomorHp" class="col-sm-2 col-form-label">Nomor Hp</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="no_hp_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputFoto" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="formFoto" name="foto_na">
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="alamat_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="floatingSelect" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="role_na" required>
                                                <option selected disabled>Pilih role...</option>
                                                <option value="admin">Admin</option>
                                                <option value="staff">Staff</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <!-- <label class="col-sm-2 col-form-label">Submit Button</label> -->
                                        <div class="col-sm-11 text-end">
                                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                                        </div>
                                    </div>

                                </form>
                                <!-- End General Form Elements -->

                            </div>
                        </div>

                    </div>

                </div>
            </section>
            <!-- End small tables -->

        </div>
    </div>

</div>