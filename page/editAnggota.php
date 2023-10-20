<?php 
if($_SESSION["login"]==0){
    echo "
    <script>
        document.location.href='index.php?page=user';
    </script>
    ";
}
$id_anggota=$_GET["id_anggota"];
//query masasiswa berdasarkan id
$anggota2=query("SELECT * FROM anggota WHERE id_anggota=$id_anggota")[0];

if(isset($_POST["edit_anggota"])){
    //mengecek apakah data telah diubah atau tidak
    if(edit($_POST)>0){
        echo "
            <script>
                document.location.href='index.php?page=anggota';
            </script>
        ";
    }else{
        echo "
        <script>
            document.location.href='index.php?page=anggota';
        </script>
    ";
    }
}

?>

<a href="index.php?page=anggota">
    <button class="btn btn-primary btn-sm">kembali</button>
</a><br><br>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="row">
    <div class="col-md-4">
        <div class="feed-box text-center">
            <section class="card">
                <div class="card-body">
                    <img class="" style="width:150px; height:auto;" alt="" src="images/<?= $anggota2["foto"];?>">
                    <div class="col-12 col-md-9"><input type="file" id="gambar" name="gambar" class="form-control-file form-control-sm"></div>
                    <br><br>
                    
                    <div class="form-group">
                        <input type="text" id="nama_anggota" name="nama_anggota" placeholder="masukan nama" class="form-control form-control-sm" value="<?= $anggota2["nama_anggota"]?>">
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="col-md-8">
        <div class="feed-box ">
            <section class="card">
                <div class="card-body">
                    <div class="card-header">
                        <strong class="card-title">Data Anggota</strong>
                    </div>
                    <br>
                    
                        <input type="hidden" name="id_anggota" value="<?= $anggota2["id_anggota"];?>">
                        <input type="hidden" name="gambarLama" value="<?= $anggota2["foto"];?>">

                        <div class="row form-group">
                            <div class="col col-md-2"><label class=" form-control-label">Nik</label></div>
                            <input type="number" id="nik" name="nik" placeholder="masukan nik" class="col-md-10 form-control form-control-sm" value="<?= $anggota2["nik"]?>">
                        </div>
                    
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="jk" class=" form-control-label">Jenis Kelamin</label></div>
                            <div class="col-md-9">
                                <select name="jk" id="jk" class="form-control-sm form-control">
                                    <option value="0">Pilih </option>
                                    <option value="pria" <?php if($anggota2["jk"]=="pria"){echo "selected";}?>>Pria </option>
                                    <option value="wanita" <?php if($anggota2["jk"]=="wanita"){echo "selected";}?>>Wanita</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row form-group">
                            <div class="col col-md-2"><label class=" form-control-label">TTL</label></div>
                            <input type="text" id="tmp_lahir" name="tmp_lahir" placeholder="tempat lahir" class="col-md-4 form-control form-control-sm" value="<?= $anggota2["tmp_lahir"]?>" autocomplete="off">
                            <input type="date" id="tgl_lahir" name="tgl_lahir" placeholder="tanggal lahir" class="col-md-6 form-control form-control-sm" value="<?= $anggota2["tgl_lahir"]?>">
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2"><label class=" form-control-label">No Telp</label></div>
                            <input type="text" id="no_telp" name="no_telp" placeholder="nomor telepon" class="col-md-10 form-control form-control-sm" value="<?= $anggota2["no_telp"]?>" autocomplete="off">
                        </div>
                    
                        <div class="row form-group">
                            <div class="col col-md-2"><label class=" form-control-label">Pekerjaan</label></div>
                            <input type="text" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan" class="col-md-10 form-control form-control-sm" value="<?= $anggota2["pekerjaan"]?>" autocomplete="off">
                        </div>
                    
                        <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Penghasilan(Rp)</label></div>
                            <input type="text" id="penghasilan" name="penghasilan" placeholder="nomor penghasilan(Rp)" class="col-md-9 form-control form-control-sm" value="<?= $anggota2["penghasilan"]?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <div class=""><label class=" form-control-label">Alamat</label></div>
                            <div class=""><textarea name="alamat" id="alamat" rows="9" placeholder="masukan alamat anda" class="form-control form-control-sm" ><?= $anggota2["alamat"]?></textarea></div>
                        </div>  

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"  name="edit_anggota">
                                <i class="fa fa-dot-circle-o"></i> Edit
                            </button>

                            <button type="reset" class="btn btn-danger ">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                        
                </div>
            </section>
        </div>
    </div>
</div>
</form>