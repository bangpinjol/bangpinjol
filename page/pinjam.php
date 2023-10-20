<?php
if($_SESSION["login"]==0){
    echo "
    <script>
        document.location.href='index.php?page=user';
    </script>
    ";
}

$pinjam=query("SELECT anggota.nama_anggota, pinjam.id_pinjam,pinjam.id_anggota,pinjam.jml_pinjam,pinjam.tgl_pinjam,pinjam.status,anggota.id_anggota
FROM anggota,pinjam
WHERE anggota.id_anggota=pinjam.id_anggota;");
$anggota=query("SELECT * FROM anggota");

if(isset($_POST["tambah_pinjam"])){
    if(tambahPinjam($_POST)>0){
        
        echo "
            <script>
                document.location.href='index.php?page=pinjam';
            </script>
        ";
    }else{
        echo "
            <script>
                document.location.href='index.php?page=pinjam';
            </script>
        ";
    }
}

if(isset($_POST["edit_pinjam"])){
    if(editPinjam($_POST)>0){
        ?>
            <script>
                document.location.href='index.php?page=pinjam';
            </script>
        <?php
    }else{
        echo "
        <script>
            document.location.href='index.php?page=pinjam';
        </script>
    ";
    }
}

if(isset($_GET["bayar"])){
    if(bayar($_GET)>0){
        ?>
            <script>
                document.location.href='index.php?page=pinjam';
            </script>
        <?php
    }else{
        echo "
        <script>
            document.location.href='index.php?page=pinjam';
        </script>
    ";
    }
}
$bunga=query("SELECT * FROM koperasi")[0];
?>
<h4>Pinjaman Koperasi</h4>
<small>Daftar dari setiap orang yang meminjam uang di koperasi dan sudah terverifikasi menjadi anggota koperasi.</small><br><br>

<!-- table -->
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <button  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tampilModalTambah">
                tambah pinjaman
                </button>
            </div>
            <div class="table-stats order-table ov-h table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Nama</th>
                            <th>Jml Pinjam<br>+bunga(<?= $bunga["bunga"];?>%)</th>
                            <th>Tangal Pinjam</th>
                            <th>Status</th>
                            <th class="serial">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $k=1;
                        foreach($pinjam as $row):
                        ?>
                        <tr>
                            <td class="serial"><?= $k?></td>
                            <td><?= $row["nama_anggota"];?></td>
                            <td><?= $row["jml_pinjam"]*(100+$bunga["bunga"])/100;?>;</td>
                            <td><?= $row["tgl_pinjam"];?></td>
                            <td>
                                <?php if($row["status"]=="belum dibayar"){?>
                                    <span class="badge badge-danger"><?= $row["status"];?></span>
                                <?php }else{?>
                                    <span class="badge badge-primary"><?= $row["status"];?></span>
                                <?php }?>
                            </td>
                            <td>
                                <a href="index.php?page=pinjam&bayar=<?= $row["id_pinjam"];?>">
                                    <button type="submit" class="btn btn-info btn-sm">bayar</button>
                                </a>
                                <a href="index.php?page=pinjam&id_pinjam=<?= $row["id_pinjam"];?>">
                                    <button type="submit" class="btn btn-success btn-sm">edit</button>
                                </a>
                                <a href="function/hapusPinjam.php?id_pinjam=<?= $row["id_pinjam"];?>" onclick="return confirm('yakin mau menghapus data?')">
                                    <button class="btn btn-danger btn-sm">hapus</button>
                                </a>
                            </td>    
                        </tr>
                        <?php 
                        $k++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if(isset($_GET["id_pinjam"])){
    $id_pinjam=$_GET["id_pinjam"];
    $pinjam2=query("SELECT * FROM pinjam WHERE id_pinjam=$id_pinjam")[0];
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <strong>Edit Pinjaman</strong>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="id_pinjam" value="<?= $pinjam2["id_pinjam"];?>">
                    <div class="form-group">
                        <div class=""><label for="id_anggota" class=" form-control-label">Jumlah Pinjam</label></div>
                        <div class=""><input type="text" id="id_anggota" name="jml_pinjam" placeholder="Masukan ID Nasabah" class="form-control form-control-sm" autocomplete="off" value="<?= $pinjam2["jml_pinjam"];?>"></div>
                        <small class="form-text text-muted">ID Nasabah diganti apabila diperlukan.</small>
                    </div>
                    <div class="form-group">
                        <div class=""><label for="tgl_simpan" class="form-control-label">Tanggal Pinjam</label></div>
                        <div class=""><input type="date" id="tgl_simpan" name="tgl_pinjam" class="form-control form-control-sm" value="<?= $pinjam2["tgl_pinjam"];?>"><small class="form-text text-muted">bulan-tanggal-tahun</small></div>
                    </div>

                    <div class="form-group">
                        <div class=""><label for="jk" class=" form-control-label">Status</label></div>
                        <div class="">
                            <select name="status" id="jk" class="form-control-sm form-control">
                                <option value="0">Pilih </option>
                                <option value="lunas" <?php if($pinjam2["status"]=="lunas"){echo "selected";}?>>lunas </option>
                                <option value="belum dibayar" <?php if($pinjam2["status"]=="belum dibayar"){echo "selected";}?>>belum dibayar</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"  name="edit_pinjam">
                            <i class="fa fa-dot-circle-o"></i> Edit
                        </button>

                        <button type="reset" class="btn btn-danger ">
                            <i class="fa fa-ban"></i> Reset
                        </button>

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <?php }?>
</div>

<!-- modal tambah -->
<div class="modal fade" id="tampilModalTambah" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Tambah Pinjaman</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <!-- awal data -->
                    <div class="card">
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group">
                                    <div class=""><label for="id_anggota" class=" form-control-label">Peminjam</label></div>
                                    <div class="">
                                        <select name="id_anggota" id="id_anggota" class="form-control-sm form-control">
                                            <option value="0">Pilih Peminjam</option>
                                            <?php foreach($anggota as $row): ?>
                                            <option value="<?= $row["id_anggota"];?>"><?= $row["nama_anggota"];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=""><label for="jml_pinjam" class=" form-control-label">Jumlah Pinjam(Rp)</label></div>
                                    <div class=""><input type="number" id="jml_pinjam" name="jml_pinjam" placeholder="masukan Jumlah Pinjam(Rp)" class="form-control form-control-sm"></div>
                                </div>
                                <div class="form-group">
                                    <div class=""><label for="tgl_pinjam" class=" form-control-label">Tanggal Pinjam</label></div>
                                    <div class=""><input type="date" id="tgl_pinjam" name="tgl_pinjam" placeholder="Masukkan Tanggal Pinjam" class="form-control form-control-sm"><small class="form-text text-muted">bulan-tanggal-tahun</small></div>
                                </div>                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary " name="tambah_pinjam">
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