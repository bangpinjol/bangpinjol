<?php
session_start();
require 'function/function.php';

if(isset($_SESSION["masuk"])){
    header("Location: index.php");
    exit;
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result=mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    $admin=query("SELECT * FROM admin WHERE username='$username'")[0];
    $nama_lengkap=$admin["nama_lengkap"];
    $anggota=query("SELECT * FROM anggota WHERE nama_anggota='$nama_lengkap'")[0];
    //cek username
    if(mysqli_num_rows($result)===1){
        //cek password
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password,$row["password"]) ){
            //set session
            $_SESSION["id_anggota"]=$anggota["id_anggota"];
            $_SESSION["nama_user"]=$admin["nama_lengkap"];            
            $_SESSION["masuk"]=true;
            if($admin["level"]=="superadmin"){
                $_SESSION["login"] =2;
            }else if($admin["level"]=="admin"){
                $_SESSION["login"] =1;
            }else{
                $_SESSION["login"]=0;
            }
            header("Location: index.php");
            exit;
        }
    }
    $error=true;
}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login User</title>
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
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-6 mt-4 ">
            <div class="card-header">
                Login User
            </div>
            <div class="card-body">
                <form action="" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="masukan email" name="username" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="masukan password" name="password">
                </div>
                <a href="index.phpindex.php?page=dashboard">
                    <button type="submit" name="login" class="btn btn-success btn-flat btn-sm m-b-30 m-t-30">Sign in</button>
                </a>
            </form>
            <small class=""> Bila belum punya akun <a href="register.php">register</a>.</small>    
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