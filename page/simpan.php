<?php
$anggota=query("SELECT * FROM anggota");

if($_SESSION["login"]==0){
    echo "
    <script>
        document.location.href='index.php?page=user';
    </script>
    ";
}
?>

<h4>Simpanan Koperasi</h4>
<br>
<h5>Daftar Nasabah</h5>
<small>Daftar dari setiap orang yang menyimpan/menabung uang di koperasi dan sudah terverifikasi menjadi anggota koperasi.</small><br><br>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="table-stats order-table ov-h table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Id Nasabah</th>
                            <th>Nama</th>
                            <th>Jenis Kel</th>
                            <th>TTL</th>
                            <th class="serial">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach($anggota as $row): ?>
                        <tr>
                            <td class="serial"><?= $i?></td>
                            <td><?= $row["id_anggota"];?></td>
                            <td><?= $row["nama_anggota"];?></td>
                            <td><?= $row["jk"];?></td>
                            <td><?= $row["tmp_lahir"];?>,<?= $row["tgl_lahir"];?></td>
                            <td>
                                <a href="index.php?page=simpanan&id_anggota=<?= $row["id_anggota"];?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Detail</button>
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
    </div>
</div>