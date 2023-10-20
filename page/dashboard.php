<?php
if($_SESSION["login"]==0){
    echo "
    <script>
        document.location.href='index.php?page=user';
    </script>
    ";
}
// menghitung jumlah anggota koperasi
$countAnggota=mysqli_query($conn, "SELECT * FROM anggota");
$count=mysqli_num_rows($countAnggota);

// menghitung semua transaksi simpan pinjam
$countSimpan=mysqli_query($conn, "SELECT * FROM simpan");
$countTarik=mysqli_query($conn, "SELECT * FROM tarik");
$countPinjam=mysqli_query($conn, "SELECT * FROM pinjam");

$countS=mysqli_num_rows($countSimpan);
$countT=mysqli_num_rows($countTarik);
$countP=mysqli_num_rows($countPinjam);

//menghitung simpanan uang
$countSimpanan=query("SELECT * FROM simpan");
$countPenarikan=query("SELECT * FROM tarik");

$totalSimpanan=0;
foreach($countSimpanan as $row):
    $totalSimpanan+=$row["jml_simpan"];
endforeach;

$totalPenarikan=0;
foreach($countPenarikan as $row):
    $totalPenarikan+=$row["jml_tarik"];
endforeach;

$countPinjaman=query("SELECT * FROM pinjam");
$totalPinjaman=0;
foreach($countPinjaman as $row):
    $totalPinjaman+=$row["jml_pinjam"];
endforeach;

// bunga
$bunga=query("SELECT * FROM koperasi")[0];
?>
<h4>Selamat Datang di Koperasi <?= $koperasi["nama_koperasi"];?></h4><br>
<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">Rp <span class="count"><?= $totalSimpanan-$totalPenarikan?></span>,-</div>
                                <div class="stat-heading">Simpanan Anggota Koperasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">Rp <span class="count"><?= $totalPinjaman*(100+$bunga["bunga"])/100;?></span>,-</div>
                                <div class="stat-heading">Uang Pinjaman Yang Belum Dikembaikan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-2">
                            <i class="pe-7s-cart"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?= $countS+$countT+$countP;?></span></div>
                                <div class="stat-heading">Transaksi Simpan Pinjam</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?= $count;?></span></div>
                                <div class="stat-heading">Anggota Koperasi Terdaftar</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- intro -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Apa saja yang dapat dilakukan program simpan pinjam koperasi <?= $koperasi["nama_koperasi"];?> ?</strong>
        </div>
        <div class="card-body">
            <p class="card-text">1. Menyediakan program simpan (tabungan) untuk anggota resmi koperasi.</p>
            <p class="card-text">2. Menyediakan pinjaman uang untuk anggota resmi koperasi.</p>
            <p class="card-text">3. Persyaratan Mudah</p>
            <p class="card-text">4. Bunga pinjaman hanya <?= $koperasi["bunga"];?>%.</p>
            <p class="card-text">5. Aman, cepat & mudah.</p>
        </div>
    </div>
</div>
<br><br><br><br>


