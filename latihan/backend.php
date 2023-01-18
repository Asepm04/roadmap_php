<?php 

// koneksi database

$host = 'localhost';
$user = 'root';
$pw   = 'asepm000';
$db   = 'data';

$koneksi = mysqli_connect($host,$user,$pw,$db);
if (!$koneksi)
{
    echo 'Tidak terhubung terhubung';
}

// end koneksi database

// input data siswa

if(isset($_POST['tambah']))
{
    $nama       = htmlspecialchars( $_POST['nama']);
    $usia       = $_POST['usia'];
    $jurusan    = $_POST['jurusan'];
    $alamat     = $_POST['alamat'];
    $email      = $_POST['email'];

    $inputan = "insert into siswa values (null,'$nama','$alamat','$usia','$email','$jurusan')";
    $query   = mysqli_query($koneksi,$inputan);
    if($query)
    {
       header("location:index.php?pesan=berhasil ditambahkan");
    }
    else{ echo 'gagal';}

}

// end input data siswa


// proses hapus data siswa

if(isset($_GET['hapus']))
{
    $id    = $_GET['hapus'];
    $hapus = "delete from siswa where ID ='$id'";
    $query = mysqli_query($koneksi,$hapus);

    if($query)
    {
        header("location:index.php?pesan=berhasil dihapus");
    }
    else
    {
        header("location:index.php?pesan=gagal dihapus");
    }
}

// end proses hapus data siswa

// update data siswa

if(isset($_POST['ubah']))
{
    $id         = $_POST['id'];
    $nama       = htmlspecialchars( $_POST['nama']);
    $usia       = $_POST['usia'];
    $jurusan    = $_POST['jurusan'];
    $alamat     = $_POST['alamat'];
    $email      = $_POST['email'];

    $update = "update siswa set NAMA ='$nama', ALAMAT='$alamat',USIA='$usia',email='$email',jurusan='$jurusan' where iD ='$id'";
    $query  = mysqli_query($koneksi,$update);

    if($query)
    {
        header('location:index.php?pesan=berhasil diubah');
    }
    else
    {
        echo 'gagal di ubah';
    }
}

// ending update db siswa

// form login

if(isset($_POST['login']))
{
    $usr =  $_POST['user'];
    $pwd =  $_POST['pw'];

    $login = mysqli_query($koneksi,"select * from siswa where email='$usr' and NAMA='$pwd'");
    $q = mysqli_num_rows($login);
    if($q == 1)
    {
        session_start();
        $_SESSION['status']   = 'login';
        
        if(isset($_POST['remember']))
        {
            $query = mysqli_query($koneksi,"select * from siswa where email ='$usr' ");
            $sql   = mysqli_fetch_assoc($query);

            setcookie("id",$sql['ID'],time()+60);
            setcookie("key",hash('sha256',$sql['email']),time()+60);
        }
        header("location:index.php");

    }
    else
    {
        echo 'gagal';
    }

}

// ending form login

?>