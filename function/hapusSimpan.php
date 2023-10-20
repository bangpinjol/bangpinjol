<?php
require 'function.php';

$id_simpan=$_GET["id_simpan"];
$id_anggota=$_GET["id_anggota"];

if(hapusSimpan($id_simpan)>0){
    ?>
    <script>
        document.location.href='../index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
    </script>
    <?php
}
