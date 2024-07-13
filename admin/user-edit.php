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
$id_na = $_GET['id_na'];
$user = mysqli_query($conn, "SELECT * FROM user_na WHERE id_na = $id_na");
?>
<?php
if (isset($_POST['submit'])) {
    if (editdatauser($_POST) >= 0) {
        echo '';
?>
        <script>
            alert('data berhasil diubah');
            window.location.href = '?data=user'
        </script>
<?php
    } else {
        echo 'data gagal diubah ';
    }
}
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <!-- <button type="button" class="btn btn-primary mt-2" style="float:right">Tambah User</button> -->
            <h5 class="card-title">Edit Data User</h5>
            <!-- <p>Add <code>.table-sm</code> to make any <code>.table</code> more compact by cutting all cell padding in half.</p> -->
            <!-- Small tables -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php foreach ($user as $u) :  ?>
                                        <input type="hidden" name="id_na" value="<?= $u['id_na'] ?>">
                                        <input type="hidden" name="gambarLama" value="<?= $u['foto_na'] ?>">
                                        <div class="row mb-3 mt-2">
                                            <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_na" value="<?= $u['nama_na'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email_na" value="<?= $u['email_na'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputNomorHp" class="col-sm-2 col-form-label">Nomor Hp</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="no_hp_na" value="<?= $u['no_hp_na'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputFoto" class="col-sm-2 col-form-label">Foto</label>
                                            <div class="col-sm-10">
                                                <img src="img/<?= $u['foto_na'] ?>" alt="" width="40"> <br>
                                                <input class="form-control" type="file" id="formFoto" name="foto_na">
                                            </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="alamat_na" value="<?= $u['alamat_na'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <!-- <label class="col-sm-2 col-form-label">Submit Button</label> -->
                                            <div class="col-sm-11 text-end">
                                                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                                            </div>
                                        </div>
                                    <?php endforeach ?>


                                </form><!-- End General Form Elements -->

                            </div>
                        </div>

                    </div>

                </div>
            </section>
            <!-- End small tables -->

        </div>
    </div>

</div>