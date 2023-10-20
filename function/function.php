<?php
//konek ke database
$conn=mysqli_connect("localhost","root","","koperasi");

//fungsi query
function query($query){
    global $conn;
    $result=mysqli_query($conn,$query);
    $rows=[];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[]=$row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    $nik=htmlspecialchars($data["nik"]);
    $nama_anggota=htmlspecialchars($data["nama_anggota"]);
    $jk=htmlspecialchars($data["jk"]);
    $tmp_lahir=htmlspecialchars($data["tmp_lahir"]);
    $tgl_lahir=htmlspecialchars($data["tgl_lahir"]);
    $no_telp=htmlspecialchars($data["no_telp"]);
    $pekerjaan=htmlspecialchars($data["pekerjaan"]);
    $penghasilan=htmlspecialchars($data["penghasilan"]);
    $alamat=htmlspecialchars($data["alamat"]);
    $username=htmlspecialchars($data["username"]);
    $password=htmlspecialchars($data["password"]);
    $password2=htmlspecialchars($data["password2"]);

    //cek apakah username telah tersedia atau tidak
    $result=mysqli_query($conn, "SELECT username FROM admin WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username yang dipilih sudah terdaftar');
            </script>
        ";
        return false;
    }
    //cek konfirmasi password
    if($password!==$password2){
    echo "<script>
            alert('password tidak sesuai');
        </script>";
        return false;   
    }

    //enkripsi password 
    $password= password_hash($password,PASSWORD_DEFAULT);
    
    //upload gambar
    $gambar =upload();
    if(!$gambar){
        return false;
    }

    //query insert data
    $query="INSERT INTO anggota
                VALUES
                ('','$nik','$nama_anggota','$gambar','$jk','$tmp_lahir','$tgl_lahir','$alamat','$no_telp','$pekerjaan','$penghasilan')
                ";
    $query2="INSERT INTO admin VALUES
            ('','$nama_anggota','$username','$password','user','$gambar')
            ";
    mysqli_query($conn, $query);
    mysqli_query($conn,$query2);
    return mysqli_affected_rows($conn);
}

function register($data){
    global $conn;
    $nik=htmlspecialchars($data["nik"]);
    $nama_anggota=htmlspecialchars($data["nama_anggota"]);
    $jk=htmlspecialchars($data["jk"]);
    $tmp_lahir=htmlspecialchars($data["tmp_lahir"]);
    $tgl_lahir=htmlspecialchars($data["tgl_lahir"]);
    $no_telp=htmlspecialchars($data["no_telp"]);
    $pekerjaan=htmlspecialchars($data["pekerjaan"]);
    $penghasilan=htmlspecialchars($data["penghasilan"]);
    $alamat=htmlspecialchars($data["alamat"]);
    $username=htmlspecialchars($data["username"]);
    $password=htmlspecialchars($data["password"]);
    $password2=htmlspecialchars($data["password2"]);

    //cek apakah username telah tersedia atau tidak
    $result=mysqli_query($conn, "SELECT username FROM admin WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username yang dipilih sudah terdaftar');
            </script>
        ";
        return false;
    }
    //cek konfirmasi password
    if($password!==$password2){
    echo "<script>
            alert('password tidak sesuai');
        </script>";
        return false;   
    }

    //enkripsi password 
    $password= password_hash($password,PASSWORD_DEFAULT);
    //upload gambar
    $gambar =upload();
    if(!$gambar){
        return false;
    }

    //query insert data
    $query="INSERT INTO anggota
            VALUES
            ('','$nik','$nama_anggota','$gambar','$jk','$tmp_lahir','$tgl_lahir','$alamat','$no_telp','$pekerjaan','$penghasilan')
            ";
    $query2="INSERT INTO admin VALUES
            ('','$nama_anggota','$username','$password','user','$gambar')
            ";
    mysqli_query($conn,$query);
    mysqli_query($conn,$query2);
    return mysqli_affected_rows($conn);
}

function tambahUser($data){
    global $conn;
    $nama_lengkap=htmlspecialchars($data["nama_lengkap"]);
    $username=htmlspecialchars($data["username"]);
    $password=htmlspecialchars($data["password"]);
    $password2=htmlspecialchars($data["password2"]);
    $level=htmlspecialchars($data["level"]);
    
    //cek apakah username telah tersedia atau tidak
    $result=mysqli_query($conn, "SELECT username FROM admin WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username yang dipilih sudah terdaftar');
            </script>
        ";
        return false;
    }
    //cek konfirmasi password
    if($password!==$password2){
    echo "<script>
            alert('password tidak sesuai');
        </script>";
        return false;   
    }

    //enkripsi password 
    $password= password_hash($password,PASSWORD_DEFAULT);

    //upload gambar
    $gambar =upload();
    if(!$gambar){
        return false;
    }

    //query insert data
    $query="INSERT INTO admin
                VALUES
                ('','$nama_lengkap','$username','$password','$level','$gambar')
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambahSimpan($data){
    global $conn;
    $id_anggota=htmlspecialchars($data["id_anggota"]);
    $jml_simpan=htmlspecialchars($data["jml_simpan"]);
    $tgl_simpan=htmlspecialchars($data["tgl_simpan"]);
    
    //query insert data
    $query="INSERT INTO simpan
                VALUES
                ('','$id_anggota','$jml_simpan','$tgl_simpan')
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambahTarik($data){
    global $conn;
    $id_anggota=htmlspecialchars($data["id_anggota"]);
    $jml_tarik=htmlspecialchars($data["jml_tarik"]);
    $tgl_tarik=htmlspecialchars($data["tgl_tarik"]);
    
    //query insert data
    $query="INSERT INTO tarik
                VALUES
                ('','$id_anggota','$jml_tarik','$tgl_tarik')
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambahPinjam($data){
    global $conn;
    $id_anggota=htmlspecialchars($data["id_anggota"]);
    $jml_pinjam=htmlspecialchars($data["jml_pinjam"]);
    $tgl_pinjam=htmlspecialchars($data["tgl_pinjam"]);
    
    //query insert data
    $query="INSERT INTO pinjam
                VALUES
                ('','$id_anggota','$jml_pinjam','$tgl_pinjam','belum dibayar')
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile =$_FILES['gambar']['name'];
    $ukuranFile=$_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName=$_FILES['gambar']['tmp_name'];

    //cek apakah gambar telah di upload
    if($error===4){
        echo "<script>
                alert('pilih gambar terlebih dahulu !!!');
            </script>";
        return false;
    }

    //validasi apakah yang di upload adalah gambar
    $extensiGambarValid=['jpg','jpeg','png','gif'];
    $extensiGambar=explode('.',$namaFile);
    $extensiGambar=strtolower(end($extensiGambar));
    
    if(!in_array($extensiGambar,$extensiGambarValid)){
        echo "<script>
                alert('yang anda upload bukan gambar');
            </script>";
        return false;
    }

    //cek ukuran apabila ingin dibatasi
    if($ukuranFile > 1000000){
        echo "<script>
                alert('gambar yang anda masukan terlalu besar');
            </script>";
        return false;
    }

    //lolos pengecekan diatas maka gambar akan di upload
    //generate nama gambar baru
    $namaFileBaru = 'img_';
    $namaFileBaru .= uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensiGambar;

    move_uploaded_file($tmpName,'images/'.$namaFileBaru);
    return $namaFileBaru;
}


function hapus($id_anggota){
    global $conn;
    mysqli_query($conn,"DELETE FROM anggota WHERE id_anggota=$id_anggota");    
    return mysqli_affected_rows($conn);
}


function hapusUser($id_admin){
    global $conn;
    mysqli_query($conn,"DELETE FROM admin WHERE id_admin=$id_admin");    
    return mysqli_affected_rows($conn);
}

function hapusSimpan($id_simpan){
    global $conn;
    mysqli_query($conn,"DELETE FROM simpan WHERE id_simpan=$id_simpan");    
    return mysqli_affected_rows($conn);
}

function hapusTarik($id_tarik){
    global $conn;
    mysqli_query($conn,"DELETE FROM tarik WHERE id_tarik=$id_tarik");    
    return mysqli_affected_rows($conn);
}

function hapusPinjam($id_pinjam){
    global $conn;
    mysqli_query($conn,"DELETE FROM pinjam WHERE id_pinjam=$id_pinjam");    
    return mysqli_affected_rows($conn);
}

function edit($data){
    global $conn;
    $id_anggota=$data["id_anggota"];
    $nik=htmlspecialchars($data["nik"]);
    $nama_anggota=htmlspecialchars($data["nama_anggota"]);
    $jk=htmlspecialchars($data["jk"]);
    $tmp_lahir=htmlspecialchars($data["tmp_lahir"]);
    $tgl_lahir=htmlspecialchars($data["tgl_lahir"]);
    $no_telp=htmlspecialchars($data["no_telp"]);
    $pekerjaan=htmlspecialchars($data["pekerjaan"]);
    $penghasilan=htmlspecialchars($data["penghasilan"]);
    $alamat=htmlspecialchars($data["alamat"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);
    
    //cek apakah gambar lama diupload apa tidak
    
    if($_FILES['gambar']['error']===4){
        $gambar=$gambarLama;
    }else{
        $gambar=upload();
    }


    //query insert data
    $query="UPDATE anggota SET
                nik='$nik',
                nama_anggota='$nama_anggota',
                jk='$jk',
                tmp_lahir='$tmp_lahir',
                tgl_lahir='$tgl_lahir',
                no_telp='$no_telp',
                pekerjaan='$pekerjaan',
                penghasilan='$penghasilan',
                alamat='$alamat',
                foto='$gambar'
                WHERE id_anggota=$id_anggota
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editAdmin($data){
    global $conn;
    $id_admin=$data["id_admin"];
    $nama_lengkap=htmlspecialchars($data["nama_lengkap"]);
    $username=htmlspecialchars($data["username"]);
    $password=htmlspecialchars($data["password"]);
    $password2=htmlspecialchars($data["password2"]);
    $level=htmlspecialchars($data["level"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);
    
    //cek apakah gambar lama diupload apa tidak
    
    if($_FILES['gambar']['error']===4){
        $gambar=$gambarLama;
    }else{
        $gambar=upload();
    }

    $result=mysqli_query($conn, "SELECT * FROM admin WHERE id_admin='$id_admin'");
    if(mysqli_num_rows($result)===1){
         //query insert data
        $row=mysqli_fetch_assoc($result);
        
        if(password_verify($password,$row["password"]) ){
            $password2= password_hash($password2,PASSWORD_DEFAULT);
            $query="UPDATE admin SET
            nama_lengkap='$nama_lengkap',
            username='$username',
            password='$password2',
            level='$level',
            gambar='$gambar'
            WHERE id_admin=$id_admin
            ";
            
            mysqli_query($conn, $query);
        }

    }else{
        echo "
        <script>
            alert('Password lama yang anda masukan salah');
        </script>
        ";
    }

    
    return mysqli_affected_rows($conn);
}

function editSimpan($data){
    global $conn;
    $id_simpan=$data["id_simpan"];
    $jml_simpan=htmlspecialchars($data["jml_simpan"]);
    $tgl_simpan=htmlspecialchars($data["tgl_simpan"]);

    //query insert data
    $query="UPDATE simpan SET
                jml_simpan='$jml_simpan',
                tgl_simpan='$tgl_simpan' 
                WHERE id_simpan=$id_simpan
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editPinjam($data){
    global $conn;
    $id_pinjam=$data["id_pinjam"];
    $jml_pinjam=htmlspecialchars($data["jml_pinjam"]);
    $tgl_pinjam=htmlspecialchars($data["tgl_pinjam"]);
    $status=htmlspecialchars($data["status"]);
    //query insert data
    $query="UPDATE pinjam SET
                jml_pinjam='$jml_pinjam',
                tgl_pinjam='$tgl_pinjam',
                status='$status' 
                WHERE id_pinjam=$id_pinjam
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function bayar($data){
    global $conn;
    $id_pinjam=$data["bayar"];
    //query insert data
    $query="UPDATE pinjam SET
                status='lunas' 
                WHERE id_pinjam=$id_pinjam
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function editTarik($data){
    global $conn;
    $id_tarik=$data["id_tarik"];
    $jml_tarik=htmlspecialchars($data["jml_tarik"]);
    $tgl_tarik=htmlspecialchars($data["tgl_tarik"]);

    //query insert data
    $query="UPDATE tarik SET
                jml_tarik='$jml_tarik',
                tgl_tarik='$tgl_tarik' 
                WHERE id_tarik=$id_tarik
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editToko($data){
    global $conn;
    $id_toko=$data["id_toko"];
    $bunga=htmlspecialchars($data["bunga"]);
    $nama_koperasi=htmlspecialchars($data["nama_koperasi"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);
    
    //cek apakah gambar lama diupload apa tidak
    
    if($_FILES['gambar']['error']===4){
        $gambar=$gambarLama;
    }else{
        $gambar=upload();
    }


    //query insert data
    $query="UPDATE koperasi SET
                bunga='$bunga',
                nama_koperasi='$nama_koperasi',
                logo='$gambar'
                WHERE id_toko=$id_toko
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}