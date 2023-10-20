<?php
$id_anggota=$_SESSION["id_anggota"];
$anggotaChoice=query("SELECT * FROM anggota WHERE id_anggota=$id_anggota")[0];
$simpan=query("SELECT * FROM simpan WHERE id_anggota=$id_anggota ORDER BY tgl_simpan DESC ");
$tarik=query("SELECT * FROM tarik  WHERE id_anggota=$id_anggota ORDER BY tgl_tarik DESC");
$pinjam=query("SELECT * FROM pinjam WHERE id_anggota=$id_anggota && status='belum dibayar' ORDER BY tgl_pinjam DESC ");

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
$countPinjam=query("SELECT * FROM pinjam WHERE id_anggota=$id_anggota && status='belum dibayar'");
$o=0;
foreach($countPinjam as $row):
    $o+=$row["jml_pinjam"];
endforeach;
?>
<div class="card">
    <div class="card-header text-center bg-success text-white">
        <strong class="card-title mb-3 ">Detail Anggota</strong>
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
                            <th scope="row">NIK</th>
                            <td scope="row"><?= $anggotaChoice["nik"];?></td>
                            <th scope="row">Nama Nasabah</th>
                            <td><?= $anggotaChoice["nama_anggota"];?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?= $anggotaChoice["jk"];?></td>
                            <th scope="row">TTL</th>
                            <td><?= $anggotaChoice["tmp_lahir"];?>, <?= $anggotaChoice["tgl_lahir"];?></td>
                        </tr>
                        <tr>
                            <th scope="row">No Telepon</th>
                            <td><?= $anggotaChoice["no_telp"];?></td>
                            <th scope="row">Penghasilan</th>
                            <td><?= $anggotaChoice["penghasilan"];?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td colspan="3"><?= $anggotaChoice["alamat"];?></td>
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-white bg-primary">
                Total Simpanan Tabungan : Rp <?= $i;?>,-
                <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#simpan_detail" aria-expanded="true" aria-controls="collapseOne">
                Detail
                </button>
            </div>
            <div id="simpan_detail" class="collapse" aria-labelledby="headingOne" data-parent="#simpan_detail">
                <div class="card-body">
                    <div class="table-stats order-table ov-h table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">Tanggal Simpan</th>
                                    <th>Jumlah Simpan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($simpan as $row): ?>
                                <tr>
                                    <td class="serial"><?= $row["tgl_simpan"]?></td>
                                    <td>Rp <?= $row["jml_simpan"];?>,-</td>
                                    
                                </tr>
                                <?php
                                endforeach;?>
                                <tr>
                                    <td>Jumlah Simpanan</td>
                                    <td> Rp <?= $i;?>,-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-white bg-warning">
                Total Penarikan Tabungan : Rp <?= $u;?>,-
                <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#tarik_detail" aria-expanded="true" aria-controls="collapseOne">
                Detail
                </button>
            </div>
            
            <div id="tarik_detail" class="collapse" aria-labelledby="headingOne" data-parent="#tarik_detail">
                <div class="card-body">
                    <div class="table-stats order-table ov-h table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">Tanggal Tarik</th>
                                    <th>Jumlah Tarik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($tarik as $row): ?>
                                <tr>
                                    <td class="serial"><?= $row["tgl_tarik"]?></td>
                                    <td>Rp <?= $row["jml_tarik"];?>,-</td>
                                </tr>
                                <?php
                                endforeach;?>
                                <tr>
                                    <td>Jumlah Penarikan</td>
                                    <td> Rp <?= $u;?>,-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-white bg-danger text-center    ">
                Total Pinjaman yang Harus Dibayar: Rp <?= $o*(100+$koperasi["bunga"])/100;?>,-
                <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#pinjam_detail" aria-expanded="true" aria-controls="collapseOne">
                Detail
                </button>
            </div>
            
            <div id="pinjam_detail" class="collapse" aria-labelledby="headingOne" data-parent="#tarik_detail">
                <div class="card-body">
                    <div class="table-stats order-table ov-h table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">Tanggal pinjam</th>
                                    <th>Jumlah Pinjam+bunga(<?= $koperasi["bunga"];?>%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($pinjam as $row): ?>
                                <tr>
                                    <td class="serial"><?= $row["tgl_pinjam"]?></td>
                                    <td>Rp <?= $row["jml_pinjam"]*(100+$koperasi["bunga"])/100;?>,-</td>
                                </tr>
                                <?php
                                endforeach;?>
                                <tr>
                                    <td>Jumlah Pinjam</td>
                                    <td> Rp <?= $o*(100+$koperasi["bunga"])/100;?>,-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>