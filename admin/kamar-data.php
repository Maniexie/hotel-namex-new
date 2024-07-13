<?php

include "../koneksi.php";
$query = "SELECT * FROM kamar_na";
$tampil = mysqli_query($conn, $query);

?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Kamar</h5>
            <a href="?data=kamar-tambah" class="btn btn-primary mt-2 " style="float:right">Tambah Kamar</a>
            <!-- Small tables -->
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Jenis Kamar</th>
                        <th scope="col">Kapasitas</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $no = 1;
                        while ($r = mysqli_fetch_array($tampil)) {
                        ?>
                            <th scope="row"><?= $no; ?></th>
                            <td>
                                <img src="img/<?php echo "$r[gambar_na]"; ?>" alt="" style="width : 70px">
                            </td>
                            <td><?php echo "$r[jenis_kamar_na]"; ?></td>
                            <td><?php echo "$r[kapasitas_na]"; ?></td>
                            <td><?php echo formatRupiah($r['harga_na']); ?></td>
                            <td>
                                <a href="?data=kamar-edit&id_kamar_na=<?php echo "$r[id_kamar_na]"; ?>" class="btn btn-primary">Edit</a>
                                <a href="?data=kamar-hapus&id_kamar_na=<?php echo "$r[id_kamar_na]"; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data Kamar <?= $r['jenis_kamar_na']; ?>')">Hapus </a>
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