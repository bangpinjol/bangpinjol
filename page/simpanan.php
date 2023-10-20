<?php 
$id_anggota=$_GET["id_anggota"];
if($_SESSION["login"]==0){
    echo "
    <script>
        document.location.href='index.php?page=user';
    </script>
    ";
}
//query masasiswa berdasarkan id
$anggota=query("SELECT * FROM anggota WHERE id_anggota=$id_anggota")[0];
$simpan=query("SELECT * FROM simpan WHERE id_anggota=$id_anggota ORDER BY tgl_simpan DESC");
$tarik=query("SELECT * FROM tarik WHERE id_anggota=$id_anggota ORDER BY tgl_tarik DESC");

if(isset($_POST["tambah_simpan"])){
    if(tambahSimpan($_POST)>0){
        ?>
            <script>
                document.location.href='index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
            </script>
        <?php
    }else{
        ?>
            <script>
                alert('data gagal ditambahkan');
                document.location.href='index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
            </script>
        <?php
    }
}

if(isset($_POST["edit_simpan"])){
    if(editSimpan($_POST)>0){
        ?>
            <script>
                document.location.href='index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
            </script>
        <?php
    }else{
        echo "
        <script>
            document.location.href='index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
        </script>
    ";
    }
}

if(isset($_POST["tambah_tarik"])){
    if(tambahTarik($_POST)>0){
        ?>
            <script>
                document.location.href='index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
            </script>
        <?php
    }else{
        ?>
            <script>
                alert('data gagal ditambahkan');
                document.location.href='index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
            </script>
        <?php
    }
}

if(isset($_POST["edit_tarik"])){
    if(editTarik($_POST)>0){
        ?>
            <script>
                //document.location.href='index.php?page=simpanan&id_anggota=<?php //$id_anggota;?>';
            </script>
        <?php
    }else{
        echo "
        <script>
            document.location.href='index.php?page=simpanan&id_anggota=<?= $id_anggota;?>';
        </script>
    ";
    }
}

$countSimpanan=query("SELECT * FROM simpan WHERE id_anggota=$id_anggota");
$i=0;
foreach($countSimpanan as $row):
    $i+=$row["jml_simpan"];
endforeach;

$countPenarikan=query("SELECT * FROM tarik WHERE id_anggota=$id_anggota");
$u=0;
foreach($countPenarikan as $row):
    $u+=$row["jml_tarik"];
endforeach;

?>

<div class="card">
    <div class="card-header">
        <strong class="card-title mb-3">Detail Nasabah</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <img src="images/<?= $anggota["foto"];?>" alt="" style="width:120px; height:auto;">
            </div>
            <div class="col-md-10">
                <table class="table" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="row">Id Nasabah</th>
                            <td scope="row"><?= $anggota["id_anggota"];?></td>
                            <th scope="row">Nama Nasabah</th>
                            <td><?= $anggota["nama_anggota"];?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?= $anggota["jk"];?></td>
                            <th scope="row">TTL</th>
                            <td><?= $anggota["tmp_lahir"];?>, <?= $anggota["tgl_lahir"];?></td>
                        </tr>
                        <tr>
                            <th>Total Simpanan</th>
                            <td colspan="3">Rp <?= $i-$u;?>,-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<div class="row">
    <!-- simpan -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"> 
                <strong class="card-title mb-3" id="simpanan">Riwayat Simpanan</strong>
                <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>&tambah=1#simpanan">
                    <button type="submit" class="btn btn-primary btn-sm">tambah simpanan</button>
                </a>
            </div>
            <div class="card-body">
                <div class="card">
                    <!-- dinamis crud simpanan -->
                    <?php
                    if(!isset($_GET["tambah"])){                    
                    ?>
                    <div class="table-stats order-table ov-h table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">Tanggal Simpan</th>
                                    <th>Jumlah Simpan</th>
                                    <th class="serial">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($simpan as $row): ?>
                                <tr>
                                    <td class="serial"><?= $row["tgl_simpan"]?></td>
                                    <td>Rp <?= $row["jml_simpan"];?>,-</td>
                                    <td>
                                        <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>&tambah=2&id_simpan=<?= $row["id_simpan"]?>">
                                            <button type="submit" class="btn btn-success btn-sm">edit</button>
                                        </a>

                                        <a href="function/hapusSimpan.php?id_simpan=<?= $row["id_simpan"]?>&id_anggota=<?= $id_anggota;?>" onclick="return confirm('yakin mau menghapus data?')">
                                            <button class="btn btn-danger btn-sm">hapus</button>
                                        </a>
                                    </td>    
                                </tr>
                                <?php 
                                endforeach;?>
                                <tr>
                                    <td>Jumlah Simpanan</td>
                                    <td> Rp <?= $i;?>,-</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php 
                        ?>
                    </div>
                    <?php
                    }else if($_GET["tambah"]==1){                  
                    ?>
                    <!-- menu tambah simpanan -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <div class=""><label for="id_anggota" class=" form-control-label">ID Nasabah</label></div>
                            <div class=""><input type="text" id="id_anggota" name="id_anggota" placeholder="Masukan ID Nasabah" class="form-control form-control-sm" autocomplete="off" value="<?= $id_anggota;?>"></div>
                            <small class="form-text text-muted">ID Nasabah diganti apabila diperlukan.</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="jml_simpan" class=" form-control-label">Masukan Nomilan Uang(Rp)</label></div>
                            <div class=""><input type="number" id="jml_simpan" name="jml_simpan" placeholder="masukan Nominal" class="form-control form-control-sm" autocomplete="off" value=""></div>
                            <small class="form-text text-muted">Masukan nominal dengan satuan Rupiah(Rp).</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="tgl_simpan" class=" form-control-label">Tanggal Simpanan</label></div>
                            <div class=""><input type="date" id="tgl_simpan" name="tgl_simpan" class="form-control form-control-sm"><small class="form-text text-muted">bulan-tanggal-tahun</small></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"  name="tambah_simpan">
                                <i class="fa fa-dot-circle-o"></i> Tambah
                            </button>

                            <button type="reset" class="btn btn-danger ">
                                <i class="fa fa-ban"></i> Reset
                            </button>
  
                        </div>
                        
                    </form>
                    <div class="card-footer text-center">
                        <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>#simpanan">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-minus-circle"></i>batal</button>
                        </a>   
                    </div>
                    
                    <!-- akhir menu tambah simpanan -->
                    
                    <?php
                    }else if($_GET["tambah"]==2){
                        $id_simpan=$_GET["id_simpan"];
                        $simpanEdit=query("SELECT * FROM simpan WHERE id_simpan=$id_simpan")[0];
                    ?>
                    <!-- menu edit simpanan -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <input type="hidden" name="id_simpan" value="<?= $simpanEdit["id_simpan"];?>">
                        <div class="form-group">
                            <div class=""><label for="id_anggota" class=" form-control-label">ID Nasabah</label></div>
                            <div class=""><input type="text" id="id_anggota" name="id_anggota" placeholder="Masukan ID Nasabah" class="form-control form-control-sm" autocomplete="off" value="<?= $id_anggota;?>" disabled></div>
                            <small class="form-text text-muted" >ID Nasabah diganti apabila diperlukan.</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="jml_simpan" class=" form-control-label">Masukan Nomilan Uang(Rp)</label></div>
                            <div class=""><input type="number" id="jml_simpan" name="jml_simpan" placeholder="masukan Nominal" class="form-control form-control-sm" autocomplete="off" value="<?= $simpanEdit["jml_simpan"];?>"></div>
                            <small class="form-text text-muted">Masukan nominal dengan satuan Rupiah(Rp).</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="tgl_simpan" class=" form-control-label">Tanggal Simpanan</label></div>
                            <div class=""><input type="date" id="tgl_simpan" name="tgl_simpan" class="form-control form-control-sm" value="<?= $simpanEdit["tgl_simpan"];?>"><small class="form-text text-muted">bulan-tanggal-tahun</small></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"  name="edit_simpan">
                                <i class="fa fa-dot-circle-o"></i> Tarik
                            </button>

                            <button type="reset" class="btn btn-danger ">
                                <i class="fa fa-ban"></i> Reset
                            </button>

                        </div>
                        
                    </form>
                    <div class="card-footer text-center">
                        <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>#simpanan">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-minus-circle"></i>batal</button>
                        </a>   
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- penarikan -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title mb-3" id="penarikan">Riwayat Penarikan</strong>
                <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>&tarik=1#penarikan">
                    <button type="submit" class="btn btn-warning btn-sm">tarik uang</button>
                </a>
            </div>
            <div class="card-body">
                <div class="card">
                    <!-- dinamis penarikan crud -->
                    <?php
                    if(!isset($_GET["tarik"])){                    
                    ?>
                    <div class="table-stats order-table ov-h table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">Tanggal Tarik</th>
                                    <th>Jumlah Tarik</th>
                                    <th class="serial">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($tarik as $row): ?>
                                <tr>
                                    <td class="serial"><?= $row["tgl_tarik"]?></td>
                                    <td>Rp <?= $row["jml_tarik"];?>,-</td>
                                    <td>
                                        <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>&tarik=2&id_tarik=<?= $row["id_tarik"]?>">
                                            <button type="submit" class="btn btn-success btn-sm">edit</button>
                                        </a>

                                        <a href="function/hapusTarik.php?id_tarik=<?= $row["id_tarik"]?>&id_anggota=<?= $id_anggota;?>" onclick="return confirm('yakin mau menghapus data?')">
                                            <button class="btn btn-danger btn-sm">hapus</button>
                                        </a>
                                    </td>    
                                </tr>
                                <?php
                                endforeach;?>
                                <tr>
                                    <td>Jumlah Penarikan</td>
                                    <td> Rp <?= $u;?>,-</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php 

                        ?>
                    </div>
                    <?php
                    }else if($_GET["tarik"]==1){                  
                    ?>
                    <!-- menu tambah simpanan -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <div class=""><label for="id_anggota" class=" form-control-label">ID Nasabah</label></div>
                            <div class=""><input type="text" id="id_anggota" name="id_anggota" placeholder="Masukan ID Nasabah" class="form-control form-control-sm" autocomplete="off" value="<?= $anggota["id_anggota"];?>"></div>
                            <small class="form-text text-muted">ID Nasabah diganti apabila diperlukan.</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="jml_tarik" class=" form-control-label">Masukan Nomilan Uang(Rp)</label></div>
                            <div class=""><input type="number" id="jml_tarik" name="jml_tarik" placeholder="masukan Nominal" class="form-control form-control-sm" autocomplete="off" value=""></div>
                            <small class="form-text text-muted">Masukan nominal dengan satuan Rupiah(Rp).</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="tgl_tarik" class=" form-control-label">Tanggal Penarikan</label></div>
                            <div class=""><input type="date" id="tgl_tarik" name="tgl_tarik" class="form-control form-control-sm"><small class="form-text text-muted">bulan-tanggal-tahun</small></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"  name="tambah_tarik">
                                <i class="fa fa-dot-circle-o"></i> Tambah
                            </button>

                            <button type="reset" class="btn btn-danger ">
                                <i class="fa fa-ban"></i> Reset
                            </button>
  
                        </div>
                        
                    </form>
                    <div class="card-footer text-center">
                        <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>#penarikan">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-minus-circle"></i>batal</button>
                        </a>   
                    </div>

                    
                    <!-- akhir menu tambah simpanan -->
                    
                    <?php
                    }else if($_GET["tarik"]==2){
                        $id_tarik=$_GET["id_tarik"];
                        $tarikEdit=query("SELECT * FROM tarik WHERE id_tarik=$id_tarik")[0];
                    ?>
                    <!-- menu edit simpanan -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <input type="hidden" name="id_tarik" value="<?= $tarikEdit["id_tarik"];?>">
                        <div class="form-group">
                            <div class=""><label for="id_anggota" class=" form-control-label">ID Nasabah</label></div>
                            <div class=""><input type="text" id="id_anggota" name="id_anggota" placeholder="Masukan ID Nasabah" class="form-control form-control-sm" autocomplete="off" value="<?= $id_anggota;?>" disabled></div>
                            <small class="form-text text-muted">ID Nasabah diganti apabila diperlukan.</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="jml_simpan" class=" form-control-label">Masukan Nomilan Uang(Rp)</label></div>
                            <div class=""><input type="number" id="jml_simpan" name="jml_tarik" placeholder="masukan Nominal" class="form-control form-control-sm" autocomplete="off" value="<?= $tarikEdit["jml_tarik"];?>"></div>
                            <small class="form-text text-muted">Masukan nominal dengan satuan Rupiah(Rp).</small>
                        </div>
                        <div class="form-group">
                            <div class=""><label for="tgl_simpan" class=" form-control-label">Tanggal Simpanan</label></div>
                            <div class=""><input type="date" id="tgl_simpan" name="tgl_tarik" class="form-control form-control-sm" value="<?= $tarikEdit["tgl_tarik"];?>"><small class="form-text text-muted">bulan-tanggal-tahun</small></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"  name="edit_tarik">
                                <i class="fa fa-dot-circle-o"></i> Edit
                            </button>

                            <button type="reset" class="btn btn-danger ">
                                <i class="fa fa-ban"></i> Reset
                            </button>

                        </div>
                        
                    </form>
                    <div class="card-footer text-center">
                        <a href="index.php?page=simpanan&id_anggota=<?= $id_anggota;?>#simpanan">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-minus-circle"></i>batal</button>
                        </a>   
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
