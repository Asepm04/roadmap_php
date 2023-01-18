<?php

//koneksi ke database
$koneksi = mysqli_connect('localhost','root','asepm000','data');

if(!$koneksi){
    echo "gagal terhubung";
}

//tambah data siswa

if(isset($_POST['tambah'])){
    $nama    = $_POST['name'];
    $umur    = $_POST['umur'];
    $jurusan = $_POST['jurusan'];
    $alamat  = $_POST['alamat'];
    $email   = $_POST['email'];

    $query = mysqli_query($koneksi,"insert into siswa value ('','$nama','$alamat','$umur','$email','$jurusan')");
    if ($query){
        header("location:index.php?pesan='berhasil_ditambahkan'");
    }else{
        header("location:index.php?pesan='gagal_ditambahkan'");
    }
}


// hapus data siswa

if(isset($_GET['del'])){
    $id    = $_GET['del'];

    $query = mysqli_query($koneksi,"delete from siswa where ID ='$id'");
    if($query)
    {
        header("location:index.php?pesan='berhasil_dihapus'");
    }else{
        header("location:index.php?pesan='gagal_dihapus'");
    }
}

// ubah data siswa

if(isset($_POST['edit'])){
    $id      = $_POST['id'];
    $nama    = $_POST['name'];
    $umur    = $_POST['umur'];
    $jurusan = $_POST['jurusan'];
    $alamat  = $_POST['alamat'];
    $email   = $_POST['email'];

    $query = mysqli_query($koneksi,"update siswa set NAMA='$nama', ALAMAT ='$alamat', USIA='$umur',email='$email',jurusan='$jurusan' where ID ='$id'");
    if ($query){
        header("location:index.php?pesan='berhasil_diubah'");
    }else{
        header("location:index.php?pesan='gagal_diubah'");
    }
}


// login

if(isset($_POST['login'])){
    $user = $_POST['user'];
    $pwd  = $_POST['pw'];

    $query = mysqli_query($koneksi,"select * from siswa where email='$user' && NAMA='$pwd'");
    $sql = mysqli_num_rows($query);
    if($sql === 1){
        // $q = mysqli_fetch_array($query);
        // if(password_verify($pwd,$q["NAMA"]))
        // {
        //     echo "anda login";
        // }else{
        //     echo "ggl";
        // }
        session_start();
        $_SESSION['status'] = "login";

        if(isset($_POST['remember'])){

        $q = mysqli_fetch_array($query);
        setcookie('id',$q['ID'],time()+60);
        setcookie('key',hash('sha256',$q['email']),time()+60);

        }

        header("location:index.php");
    }else{
        echo "gagal login";
    }
}


?>