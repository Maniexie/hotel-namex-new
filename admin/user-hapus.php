<?php
require_once("../koneksi.php");
$id_na = $_GET['id_na'];

if (hapusdatauser($id_na) >= 0) {
?>
    <script>
        alert('data berhasil di hapus');
        window.location.href = "?data=user";
    </script>
<?php
}
?>