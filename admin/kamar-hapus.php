<?php
require_once("../koneksi.php");
$id_kamar_na = $_GET['id_kamar_na'];

if (hapusdatakamar($id_kamar_na) >= 0) {
?>
    <script>
        alert('data kamar berhasil di hapus');
        window.location.href = "?data=kamar-data";
    </script>
<?php
}
?>