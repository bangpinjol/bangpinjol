<?php
require 'function.php';

$id_tarik=$_GET["id_tarik"];
$id_anggota=$_GET["id_anggota"];

if(hapusTarik($id_tarik)>0){
    ?>
    <script>
        document.location.href='../index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
    </script>
    <?php
}
