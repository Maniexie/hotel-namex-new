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
?>
<?php
if (isset($_POST['submit'])) {
    if (tambahdatakamar($_POST) >= 0) {
        echo '';
?>
        <script>
            alert('data kamar berhasil ditambahkan');
            window.location.href = '?data=kamar-data'
        </script>
<?php
    } else {
        echo 'data kamar gagal di tambahkan ';
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
                                    <div class="row mb-3 mt-2">
                                        <label for="inputNamaKamar" class="col-sm-2 col-form-label">Gambar Kamar</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="gambar_na">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputJenisKamar" class="col-sm-2 col-form-label">Jenis Kamar</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jenis_kamar_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputKapasitasKamar" class="col-sm-2 col-form-label">Kapasitas</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="kapasitas_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputHargaKamar" class="col-sm-2 col-form-label">Harga</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="harga_na" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- <label class="col-sm-2 col-form-label">Submit Button</label> -->
                                        <div class="col-sm-11 text-end">
                                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                                        </div>
                                    </div>

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