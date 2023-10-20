<?php
if($_SESSION["login"]==0){
    echo "
    <script>
        document.location.href='index.php?page=user';
    </script>
    ";
}else if($_SESSION["login"]==1){
    echo "
    <script>
        document.location.href='index.php?page=dashboard';
    </script>
    ";
}
$koperasi2=query("SELECT * FROM koperasi")[0];

if(isset($_POST["edit_toko"])){
    //mengecek apakah data telah diubah atau tidak
    if(editToko($_POST)>0){
        echo "
            <script>
                document.location.href='index.php?page=kelolaKoperasi';
            </script>
        ";
    }else{
        echo "
        <script>
            document.location.href='index.php?page=kelolaKoperasi';
        </script>
    ";
    }
}
?>
<h4>Kelola Koperasi</h4>
<small>Menu ini digunakan untuk kostumisasi koperasi.</small> <br><br>
<div class="row">
    <div class="card col-md-6">
        <div class="card-body card-block">
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="id_toko" value="<?= $koperasi2["id_toko"];?>">
                <input type="hidden" name="gambarLama" value="<?= $koperasi2["logo"];?>">
                <div class="form-group">
                    <div class=""><label for="nama_koperasi" class=" form-control-label">Nama Koperasi</label></div>
                    <div class=""><input type="text" id="nama_koperasi" name="nama_koperasi" placeholder="masukan nama koperasi" class="form-control form-control-sm" autocomplete="off" value="<?= $koperasi2["nama_koperasi"]; ?>"></div>
                </div>
                <div class="form-group">
                    <div class=""><label for="bunga" class=" form-control-label">Bunga (%) </label></div>
                    <div class=""><input type="number" id="bunga" name="bunga" placeholder="masukan bunga (%)" class="form-control form-control-sm" autocomplete="off" value="<?= $koperasi2["bunga"]; ?>"></div>
                </div>
                
                <img src="images/<?=$koperasi2["logo"] ?>" alt="" style="width:100px; height:auto;">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="logo" class=" form-control-label">Masukan gambar</label></div>
                    <div class="col-12 col-md-9"><input type="file" id="logo" name="gambar" class="form-control-file form-control-sm"></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary " name="edit_toko">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger ">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>