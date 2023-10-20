<?php
require 'function.php';
$id_pinjam=$_GET["id_pinjam"];

if(hapusPinjam($id_pinjam)>0){
    ?>
    <script>
        document.location.href='../index.php?page=pinjam';
    </script>
    <?php
}
