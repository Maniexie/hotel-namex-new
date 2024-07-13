<div class="pagetitle">
    <h1>Kamar</h1>
    <nav>
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>
    </nav>
</div><!-- End Page Title -->

<?php
require_once '../koneksi.php';
$id_kamar_na = $_GET['id_kamar_na'];
$kamar = mysqli_query($conn, "SELECT * FROM kamar_na WHERE id_kamar_na = $id_kamar_na");
?>
<?php
if (isset($_POST['submit'])) {
    if (editdatakamar($_POST) >= 0) {
        echo '';
?>
        <script>
            alert('data kamar berhasil dirubah');
            window.location.href = '?data=kamar-data'
        </script>
<?php
    } else {
        echo 'data kamar gagal di rubah ';
    }
}
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Data Kamar</h5>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php foreach ($kamar as $kmr) :  ?>
                                        <input type="hidden" name="id_kamar_na" value="<?= $kmr['id_kamar_na'] ?>">
                                        <input type="hidden" name="gambarLamaKamar" value="img/<?= $kmr['gambar_na'] ?>">
                                        <div class="row mb-3 mt-2">
                                            <label for="inputNamaKamar" class="col-sm-2 col-form-label">Gambar Kamar</label>
                                            <div class="col-sm-10">
                                                <img src="img/<?= $kmr['gambar_na'] ?>" alt="" width="40"> <br>
                                                <input type="file" class="form-control" name="gambar_na">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputJenisKamar" class="col-sm-2 col-form-label">Jenis Kamar</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="jenis_kamar_na" value="<?= $kmr['jenis_kamar_na']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputKapasitasKamar" class="col-sm-2 col-form-label">Kapasitas</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="kapasitas_na" value="<?= $kmr['kapasitas_na']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputHargaKamar" class="col-sm-2 col-form-label">Harga</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="harga_na" value="<?= $kmr['harga_na']; ?>" required>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <!-- <label class="col-sm-2 col-form-label">Submit Button</label> -->
                                            <div class="col-sm-12 text-end">
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