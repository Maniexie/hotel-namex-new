<?php
include "../koneksi.php";

$query = "SELECT * FROM pemesanan_na";
$tampil = mysqli_query($conn, $query);
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Pemesanan</h5>
            <table class="table table-sm">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Pemesan</th>
                        <th scope="col">Email Pemesan</th>
                        <th scope="col">id Kamar </th>
                        <th scope="col">Nomor Hp</th>
                        <th scope="col">Check In</th>
                        <th scope="col">Check Out</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($r = mysqli_fetch_array($tampil)) {
                    ?>
                        <tr class="text-center">
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $r['nama_na']; ?></td>
                            <td><?= $r['email_na']; ?></td>
                            <td>
                                <?php
                                $id_kamar = $r['id_kamar_na'];
                                $query_jenis_kamar = "SELECT jenis_kamar_na FROM kamar_na WHERE id_kamar_na = '$id_kamar'";
                                $result_jenis_kamar = mysqli_query($conn, $query_jenis_kamar);
                                $row_jenis_kamar = mysqli_fetch_assoc($result_jenis_kamar);
                                echo $row_jenis_kamar['jenis_kamar_na'];
                                ?>
                            </td>
                            <td><?= $r['nohp_na']; ?></td>
                            <td><?= $r['check_in_na']; ?></td>
                            <td><?= $r['check_out_na']; ?></td>
                            <td><?= formatRupiah($r['total_harga_na']); ?></td>
                            <?php
                            if ($r['status_na'] == 'pending') {
                                echo '<td style="width:120px" class="bg-danger text-center">pending</td>';
                            } elseif ($r['status_na'] == 'menunggu verifikasi') {
                                echo '<td class="bg-warning" style="width:20px">proses</td>';
                            } elseif ($r['status_na'] == 'terverifikasi') {
                                echo '<td class="bg-success" style="width:20px">terverifikasi</td>';
                            } elseif ($r['status_na'] == '') {
                                echo '<td class="bg-danger" style="width:20px">pending</td>';
                            } elseif ($r['status_na'] == 'proses') {
                                echo '<td class="bg-info" style="width:20px">proses</td>';
                            } elseif ($r['status_na'] == 'dibatalkan') {
                                echo '<td class="bg-secondary" style="width:20px">dibatalkan</td>';
                            }
                            ?>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailPemesanan<?= $r['id_pemesanan_na']; ?>">
                                    Detail
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePemesanan<?= $r['id_pemesanan_na']; ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detail Pemesanan -->
                        <div class="modal fade" id="detailPemesanan<?= $r['id_pemesanan_na']; ?>" tabindex="-1" aria-labelledby="detailPemesananLabel<?= $r['id_pemesanan_na']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailPemesananLabel<?= $r['id_pemesanan_na']; ?>">Detail Pemesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama Pemesan:</strong> <?= $r['nama_na']; ?></p>
                                        <p><strong>Email Pemesan:</strong> <?= $r['email_na']; ?></p>
                                        <p><strong>ID Kamar:</strong> <?= $r['id_kamar_na']; ?></p>
                                        <p><strong>Nomor HP:</strong> <?= $r['nohp_na']; ?></p>
                                        <p><strong>Check In:</strong> <?= $r['check_in_na']; ?></p>
                                        <p><strong>Check Out:</strong> <?= $r['check_out_na']; ?></p>
                                        <p><strong>Total Harga:</strong> <?= formatRupiah($r['total_harga_na']); ?></p>
                                        <p class="bg-danger"><strong>Status:</strong> <?= $r['status_na']; ?></p>
                                        <p><strong>Keterangan:</strong> <?= $r['keterangan_na']; ?></p>
                                        <p><strong>Bukti Pembayaran:</strong>
                                            <img src="../proses/uploads/<?= $r['bukti_pembayaran_na']; ?>" class="img-fluid" alt="">
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="pemesanan-konfirmasi.php" method="POST">
                                            <input type="hidden" name="id_pemesanan_na" value="<?= $r['id_pemesanan_na']; ?>">
                                            <button type="submit" name="konfirmasi_pembayaran" class="btn btn-primary" onclick="return confirm('yakin?')">Konfirmasi Pembayaran</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Detail Pemesanan -->

                        <!-- Modal Delete Pemesanan-->
                        <div class="modal fade" id="deletePemesanan<?= $r['id_pemesanan_na']; ?>" tabindex="-1" aria-labelledby="deletePemesananLabel<?= $r['id_pemesanan_na']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletePemesananLabel<?= $r['id_pemesanan_na']; ?>">Konfirmasi Hapus Pemesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Anda yakin ingin membatalkan pemesanan ini?</p>
                                        <p><strong>Nama Pemesan:</strong> <?= $r['nama_na']; ?></p>
                                        <p><strong>ID Pemesanan:</strong> <?= $r['id_pemesanan_na']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="pemesanan-hapus.php" method="POST">
                                            <input type="hidden" name="id_pemesanan_na" value="<?= $r['id_pemesanan_na']; ?>">
                                            <button type="submit" name="batalkan_pemesanan" class="btn btn-danger" onclick="return confirm('Anda yakin ingin membatalkan pemesanan ini?')">Batalkan Pemesanan</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Delete Pemesanan -->

                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>