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
$anggota2=query("SELECT * FROM anggota WHERE id_anggota=$id_anggota")[0];
?>

<a href="index.php?page=anggota">
    <button class="btn btn-primary btn-sm">kembali</button>
</a><br><br>

<div class="row">
    <div class="col-md-4">
        <div class="feed-box text-center">
            <section class="card">
                <div class="card-body">
                    <a href="#">
                        <img class="" style="width:150px; height:auto;" alt="" src="images/<?= $anggota2["foto"];?>">
                    </a>
                    <br>
                    <h3><?= $anggota2["nama_anggota"]?></h2>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="row">NIK</th>
                                <td scope="row"><?= $anggota2["nik"];?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Jenis Kelamin</th>
                                <td><?= $anggota2["jk"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">TTL</th>
                                <td><?= $anggota2["tmp_lahir"];?>, <?= $anggota2["tgl_lahir"];?><br>
                                    <small>tahun-bulan-tanggal</small>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">No Telp</th>
                                <td><?= $anggota2["no_telp"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Pekerjaan</th>
                                <td><?= $anggota2["pekerjaan"];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Penghasilan</th>
                                <td>Rp <?= $anggota2["penghasilan"];?>,-</td>
                            </tr>
                            <tr>
                                <th scope="row">Alamat</th>
                                <td><?= $anggota2["alamat"];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>