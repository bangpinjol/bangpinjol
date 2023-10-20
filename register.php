<?php
session_start();
require 'function/function.php';
if(isset($_POST["register"])){
    if(register($_POST)>0){
        echo "
        <script>
            document.location.href='login.php';
        </script>
    ";
    $_SESSION["masuk"]=true;
    $_SESSION["login"]=0;
    }else{
        echo "
        <script>
            document.location.href='index.php?page=login';
        </script>
        ";
    }
}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
    body{
    background-color: #eaeaea
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-9 mt-4 ">
                <div class="card-header">
                    Registrasi User Koperasi
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class=""><label for="nik" class=" form-control-label">NIK</label></div>
                                <input type="number" id="nik" name="nik" placeholder="masukan nik" class="form-control form-control-sm" >
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
                                <div class=""><input type="number" id="penghasilan" name="penghasilan" placeholder="masukan penghasilan anda(Rp)" class="form-control form-control-sm" autocomplete="off"></div>
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
                            <button class="btn btn-primary btn-block" name="register">Register</button>
                            
                        </div>
                        <small class=""> Sudah punya akun <a href="login.php">login</a>.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>