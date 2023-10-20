<?php
require 'function.php';

$id_admin=$_GET["id_admin"];
if(hapusUser($id_admin)>0){
    echo "
    <script>
        document.location.href='../index.php?page=kelolaUser';
    </script>
    ";
}


?>