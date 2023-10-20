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
if($_SESSION["login"]>1){
    
    $admin=query("SELECT * FROM admin WHERE level='superadmin' || level='admin'");

    if(isset($_POST["tambah_user"])){
        if(tambahUser($_POST)>0){
            echo "
                <script>
                    document.location.href='index.php?page=kelolaUser';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('data gagal ditambah');
                    document.location.href='index.php?page=kelolaUser';
                </script>
            ";
        }
    }
    //edit
    if(isset($_POST["edit_user"])){
        //mengecek apakah data telah diubah atau tidak
        if(editAdmin($_POST)>0){
            echo "
                <script>
                    document.location.href='index.php?page=kelolaUser';
                </script>
            ";
        }else{
            echo "
                <script>
                    //document.location.href='index.php?page=admin';
                </script>
        ";
        }
    }

?>

<h4>Menu Pengelolaan User</h4>
<small>Menu ini merupakan menu pengelolaan user yang dapat mengelola dan mengunakan aplikasi.</small>
<br><br>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <button  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tampilModalTambah">
                tambah user
                </button>
            </div>

            
            <div class="table-stats order-table ov-h table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th class="serial">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach($admin as $row):
                        ?>
                        <tr>
                            <td class="serial"><?= $i?></td>
                            <td><img src="images/<?= $row["gambar"];?>" alt="" style="width:100px; height:auto;"></td>
                            <td><?= $row["nama_lengkap"];?></td>
                            <td><?= $row["username"];?></td>
                            <td><?= $row["level"];?></td>
                            <td>
                                <a href="index.php?page=kelolaUser&id_admin=<?= $row["id_admin"];?>">
                                    <button type="submit" class="btn btn-success btn-sm">edit</button>
                                </a>
                                <a href="function/hapusUser.php?id_admin=<?= $row["id_admin"];?>" onclick="return confirm('yakin mau menghapus data?')">
                                    <button class="btn btn-danger btn-sm">hapus</button>
                                </a>
                            </td>    
                        </tr>
                        <?php 
                        $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- edit -->
    <?php
        if(isset($_GET["id_admin"])>0){
        $id_admin=$_GET["id_admin"];
        $admin2=query("SELECT * FROM admin WHERE id_admin=$id_admin")[0];
    ?>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <strong class="card-title mb-3">Edit User</strong>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="id_admin" value="<?= $admin2["id_admin"];?>">
                    <input type="hidden" name="gambarLama" value="<?= $admin2["gambar"];?>">
                    
                    <div class="form-group">
                        <div class=""><label for="nama_lengkap" class=" form-control-label">Nama Lengkap</label></div>
                        <div class=""><input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="masukan nama lengkap" class="form-control form-control-sm" autocomplete="off" value="<?= $admin2["nama_lengkap"]?>"></div>
                    </div>
                    <div class="form-group">
                        <div class=""><label for="username" class=" form-control-label">Email</label></div>
                        <div class=""><input type="text" id="username" name="username" placeholder="masukan email" class="form-control form-control-sm" autocomplete="off" value="<?= $admin2["username"]?>"></div>
                    </div>
                    <div class="form-group">
                        <div class=""><label for="password" class=" form-control-label">Password Lama</label></div>
                        <div class=""><input type="password" id="password" name="password" placeholder="masukan password lama" class="form-control form-control-sm"></div>
                    </div>
                    <div class="form-group">
                        <div class=""><label for="password2" class=" form-control-label">Password Baru</label></div>
                        <div class=""><input type="password" id="password2" name="password2" placeholder="konfirmasi password baru" class="form-control form-control-sm"></div>
                    </div>

                    <div class="form-group">
                        <div class=""><label for="level" class=" form-control-label">Level</label></div>
                        <div class="">
                            <select name="level" id="level" class="form-control-sm form-control">
                                <option value="0">Pilih Level</option>
                                <option value="superadmin" <?php if($admin2["level"]=="superadmin"){echo "selected";}?>>Superadmin</option>
                                <option value="admin" <?php if($admin2["level"]=="admin"){echo "selected";}?>>admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <img class="" style="width:auto; height:150px;" alt="" src="images/<?= $admin2["gambar"];?>">
                        <div class="col-12 col-md-9"><input type="file" id="gambar" name="gambar" class="form-control-file form-control-sm"></div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="edit_user">
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
    <?php };?>
    <!-- akhir edit -->
</div>


<!-- modal tambah anggota-->
<div class="modal fade" id="tampilModalTambah" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                 Tambah User Koperasi
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div >
                    <!-- awal data -->
                    <div class="card">
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group">
                                    <div class=""><label for="nama_lengkap" class=" form-control-label">Nama Lengkap</label></div>
                                    <div class=""><input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="masukan nama lengkap" class="form-control form-control-sm" autocomplete="off"></div>
                                </div>
                                <div class="form-group">
                                    <div class=""><label for="username" class=" form-control-label">Email</label></div>
                                    <div class=""><input type="text" id="username" name="username" placeholder="masukan email" class="form-control form-control-sm" autocomplete="off"></div>
                                </div>
                                <div class="form-group">
                                    <div class=""><label for="password" class=" form-control-label">Password</label></div>
                                    <div class=""><input type="password" id="password" name="password" placeholder="masukan password" class="form-control form-control-sm"></div>
                                </div>
                                <div class="form-group">
                                    <div class=""><label for="password2" class=" form-control-label">Konfirmasi Password</label></div>
                                    <div class=""><input type="password" id="password2" name="password2" placeholder="konfirmasi password" class="form-control form-control-sm"></div>
                                </div>

                                <div class="form-group">
                                    <div class=""><label for="level" class=" form-control-label">Level</label></div>
                                    <div class="">
                                        <select name="level" id="level" class="form-control-sm form-control">
                                            <option value="0">Pilih Level</option>
                                            <option value="superadmin">Superadmin</option>
                                            <option value="admin">admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="gambar" class=" form-control-label">Masukan gambar</label></div>
                                    <div class="col-12 col-md-9"><input type="file" id="gambar" name="gambar" class="form-control-file form-control-sm"></div>
                                </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary " name="tambah_user">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger ">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                    <!-- akhir data -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /modal tambah anggota-->
<?php
}
?>