<?php
$anggota=query("SELECT * FROM anggota");

if($_SESSION["login"]==0){
    echo "
    <script>
        document.location.href='index.php?page=user';
    </script>
    ";
}

//cek tombol tambah data telah diklik
if(isset($_POST["tambah_anggota"])){
    if(tambah($_POST)>0){
        
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
<h4>Daftar Anggota Koperasi</h4>
<small>Daftar dari setiap orang yang sudah terverifikasi dan secara resmi masuk keanggotaan koperasi.</small><br><br>

<!-- table -->
<div class="card">
    <div class="card-header">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tampilModalTambah">
        tambah anggota
        </button>
    </div>
    <div class="table-stats order-table ov-h table-responsive">
        <table class="table ">
            <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kel</th>
                    <th>TTL</th>
                    <th>No Telp</th>
                    <th class="serial">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                foreach($anggota as $row): ?>
                <tr>
                    <td class="serial"><?= $i?></td>
                    <td><?= $row["nik"];?></td>
                    <td><?= $row["nama_anggota"];?></td>
                    <td><?= $row["jk"];?></td>
                    <td><?= $row["tmp_lahir"];?>,<?= $row["tgl_lahir"];?></td>
                    <td><?= $row["no_telp"];?></td>
                    <td>
                        <a href="index.php?page=editAnggota&id_anggota=<?= $row["id_anggota"];?>">
                            <button type="submit" class="btn btn-success btn-sm">edit</button>
                        </a>

                        <a href="function/hapus.php?id_anggota=<?= $row["id_anggota"];?>" onclick="return confirm('yakin mau menghapus data?')">
                            <button class="btn btn-danger btn-sm">hapus</button>
                        </a>
                        <a href="index.php?page=tampilAnggota&id_anggota=<?= $row["id_anggota"];?>">
                            <button type="submit" class="btn btn-primary btn-sm">detail</button>
                        </a>
                    </td>    
                </tr>
                <?php 
                $i++;
                endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<!-- modal tambah -->
<div class="modal fade" id="tampilModalTambah" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Tambah Anggota Koperasi</strong>
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
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <div class=""><label for="nik" class=" form-control-label">NIK</label></div>
                                        <div class=""><input type="number" id="nik" name="nik" placeholder="masukan nik" class="form-control form-control-sm" ></div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class=""><label for="nama_anggota" class=" form-control-label">Nama</label></div>
                                        <div class=""><input type="text" id="nama_anggota" name="nama_anggota" placeholder="masukan nama" class="form-control form-control-sm" autocomplete="off"></div>
                                    </div>

                                    <div class="form-group col-4">
                                        <div class=""><label for="jk" class=" form-control-label">Jenis Kelamin</label></div>
                                        <div class="">
                                            <select name="jk" id="jk" class="form-control-sm form-control">
                                                <option value="0">Pilih </option>
                                                <option value="pria">Pria </option>
                                                <option value="wanita">Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="form-group col-4">
                                        <div class=""><label for="tmp_lahir" class=" form-control-label">Tempat Lahir</label></div>
                                        <div class=""><input type="text" id="tmp_lahir" name="tmp_lahir" placeholder="masukan tempat lahir" class="form-control form-control-sm" autocomplete="off"></div>
                                    </div>

                                    <div class="form-group col-4">
                                        <div class=""><label for="tgl_lahir" class=" form-control-label">Tanggal Lahir</label></div>
                                        <div class=""><input type="date" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" class="form-control form-control-sm"><small class="form-text text-muted">bulan-tanggal-tahun</small></div>
                                    </div>

                                    <div class="form-group col-4">
                                        <div class=""><label for="no_telp" class=" form-control-label">No Telepon</label></div>
                                        <div class=""><input type="text" id="no_telp" name="no_telp" placeholder="masukan no telepon" class="form-control form-control-sm" autocomplete="off"></div>
                                    </div>

                                    <div class="form-group col-4">
                                        <div class=""><label for="pekerjaan" class=" form-control-label">Pekerjaan</label></div>
                                        <div class=""><input type="text" id="pekerjaan" name="pekerjaan" placeholder="masukan pekerjaan anda" class="form-control form-control-sm" autocomplete="off"></div>
                                    </div>

                                    <div class="form-group col-4">
                                        <div class=""><label for="penghasilan" class=" form-control-label">Penghasilan(Rp)</label></div>
                                        <div class=""><input type="text" id="penghasilan" name="penghasilan" placeholder="masukan penghasilan anda(Rp)" class="form-control form-control-sm" autocomplete="off"></div>
                                    </div>

                                    <div class="form-group col-12">
                                        <div class=""><label for="alamat" class=" form-control-label">Alamat</label></div>
                                        <div class=""><textarea name="alamat" id="alamat" rows="3" placeholder="masukan alamat anda" class="form-control form-control-sm"></textarea></div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div class=""><label for="username" class=" form-control-label">Email</label></div>
                                        <div class=""><input type="text" id="username" name="username" placeholder="masukan email" class="form-control form-control-sm" autocomplete="off"></div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div class=""><label for="password" class=" form-control-label">Password</label></div>
                                        <div class=""><input type="password" id="password" name="password" placeholder="masukan password" class="form-control form-control-sm"></div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div class=""><label for="password2" class=" form-control-label">Konfirmasi Password</label></div>
                                        <div class=""><input type="password" id="password2" name="password2" placeholder="konfirmasi password" class="form-control form-control-sm"></div>
                                    </div>

                                    <div class="row form-group col-12">
                                        <div class="col col-md-3"><label for="gambar" class=" form-control-label">Masukan gambar</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="gambar" name="gambar" class="form-control-file form-control-sm"></div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary " name="tambah_anggota">
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

<!-- /modal tambah -->
