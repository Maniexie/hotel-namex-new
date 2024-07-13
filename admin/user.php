<div class="pagetitle">
    <h1>Tambah User</h1>
    <nav>
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>
    </nav>
</div><!-- End Page Title -->

<?php
include "../koneksi.php";
$query = "SELECT * FROM user_na";
$tampil = mysqli_query($conn, $query);
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <a href="?data=user-tambah" class="btn btn-primary mt-2 " style="float:right">Tambah User</a>
            <h5 class="card-title">Data User</h5>
            <!-- <p>Add <code>.table-sm</code> to make any <code>.table</code> more compact by cutting all cell padding in half.</p> -->
            <!-- Small tables -->
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($r = mysqli_fetch_array($tampil)) {
                    ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td>
                                <img src="img/<?php echo "$r[foto_na]"; ?>" alt="" style="width :50px">
                            </td>
                            <td><?php echo "$r[nama_na]"; ?></td>
                            <td><?php echo "$r[email_na]"; ?></td>
                            <td><?php echo "$r[no_hp_na]"; ?></td>
                            <td><?php echo "$r[alamat_na]"; ?></td>
                            <td>
                                <a href="?data=user-edit&id_na=<?= $r['id_na']; ?>" class="btn btn-primary">Edit</a>
                                <a href="?data=user-hapus&id_na=<?= $r['id_na']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data <?= $r['nama_na']; ?>?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- End small tables -->

        </div>
    </div>

</div>