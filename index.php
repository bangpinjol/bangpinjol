<?php
session_start();
if(!isset($_SESSION["masuk"])){
    header("Location: login.php");
    exit;
}
require 'function/function.php';
$koperasi=query("SELECT * FROM koperasi")[0];

if($_SESSION["login"]>=0){   
    if($_SESSION["login"]>=0){
        $page=isset($_GET["page"])?$_GET["page"]:false;
    }else{
        echo "halaman tidak tersedia";
    }
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>koperasi Desa</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
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
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    

<style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
            height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
</style>

</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php if($_SESSION["login"]>0){ ?>
                    <li class="<?php if($page=="dashboard"){echo "active";}?>">
                        <a href="index.php?page=dashboard"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Fitur</li>
                    <li class="<?php if($page=="anggota"){echo "active";}?>">
                        <a href="index.php?page=anggota"><i class="menu-icon fa fa-users"></i>Anggota </a>
                    </li>
                    <li class="menu-item-has-children dropdown <?php if($page=="simpan"||$page=="pinjam"||$page=="simpanan"){echo "active";}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Menu</a>
                        <ul class="sub-menu children dropdown-menu">                           
                            <li class=""><i class="fa fa-university"></i><a href="index.php?page=simpan">Simpan</a></li>
                            <li><i class="fa fa-money"></i><a href="index.php?page=pinjam">Pinjam</a></li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php
                        if($_SESSION["login"]>1):
                    ?>
                    <li class="menu-item-has-children dropdown <?php if($page=="kelolaUser"){echo "active";}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lock"></i>Admin</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="index.php?page=kelolaUser">Kelola User</a></li>
                            <li><i class="fa fa-shopping-cart"></i><a href="index.php?page=kelolaKoperasi">Kelola Koperasi</a></li>
                        </ul>
                    </li>
                    <?php 
                        endif;
                    ?>
                    <?php if($_SESSION["login"]==0){ ?>
                    <li class="<?php if($page=="user"){echo "active";}?>">
                        <a href="index.php?page=user"><i class="menu-icon fa fa-user"></i> <?= $_SESSION["nama_user"] ?> </a>
                    </li>

                    <?php } ?>
                    <li class="<?php if($page=="credit"){echo "active";}?>">
                        <a href="index.php?page=credit"><i class="menu-icon fa fa-user-secret"></i> Credit </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="" href="index.php?page=dashboard"><img src="images/<?= $koperasi["logo"];?>" alt="<?= $koperasi["logo"];?>" style="width:40px; height:auto; display:inline-block;"></a>
                    <strong><?= $koperasi["nama_koperasi"];?></strong>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                    
                </div>
                <div class="top-left">
                    
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i><button class="btn btn-sm btn-info">Logout</button></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
        <?php
            $file="page/$page.php";
            if($page==""){
                if ($_SESSION["login"]==0) {
                ?>
                    <script>
                        document.location.href='index.php?page=user';
                    </script>
                <?php
                }else{
                ?>
                    <script>
                        document.location.href='index.php?page=dashboard';
                    </script>
                <?php
                }
            }
            if(file_exists("$file")){
                include_once($file);
            }else{
                echo "<h3>Halaman Belum dibuat</h3>";
            }
        ?>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>

    <!--Local Stuff-->
    <script src="js/script.js"></script>
</body>
</html>
<?php
}
?>