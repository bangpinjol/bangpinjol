<?php
require 'function.php';

$id_anggota=$_GET["id_anggota"];
if(hapus($id_anggota)>0){
    echo "
    <script>
        document.location.href='../index.php?page=anggota';
    </script>
    ";
}


?>