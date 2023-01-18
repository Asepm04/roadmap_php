<?php
include 'backend.php';
session_start();
if(isset($_COOKIE['id']) && isset($_COOKIE['key']))
{
    $id = $_COOKIE['id'];
    $key= $_COOKIE['key'];
    
    $query = mysqli_query($koneksi,"select email  from siswa where ID ='$id'");
    $sql   = mysqli_fetch_assoc($query);
    if($key = hash('sha256',$sql['email']))
    {
        $_SESSION['status']=true;
    }
    else {echo "gagal cok";}
}
if($_SESSION['status']!="login")
{
    header("location:login.php?pesan='anda bukan admin'");
}

include 'backend.php';

$tampil = "select * from siswa ";
$query  = mysqli_query($koneksi,$tampil);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>how to make crud</title>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid text-light bg-secondary">
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <br><br><br>
                <a href="" class="btn btn-danger btn-lg " data-bs-toggle="modal" data-bs-target="#tambahdata">Tambah data</a>

                            <!-- Modal -->
                            <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <form action="backend.php" method="post" class="form-group">

                                   <label for="" class=" form-text form-label">Nama Mahasiswa</label>
                                   <input type="text" name="nama" placeholder="nama kamu" class="form-control" required="">
                                   <label for="" class=" form-text form-label">Usia</label>
                                   <input type="text" name="usia" placeholder="Usia" class="form-control" required="">
                                   <label for="" class="form-label form-text">Jurusan</label>
                                   <select name="jurusan" id="" class="form-control">
                                    <option value="">prodi</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Ilmu komunikasi">Ilmu komunikasi</option>
                                    <option value="Ilmu Komputer">Ilmu Komputer</option>
                                   </select>
                                   <label for="" class=" form-text form-label">Alamat</label>
                                   <input type="text" name="alamat" placeholder="Alamat" class="form-control" required="">
                                   <label for="" class=" form-text form-label">Email aktif</label>
                                   <input type="email" name="email" placeholder="Email" class="form-control" required="">

                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" name="tambah" value="tambah" class="btn btn-primary">
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- end modal -->

                            <a href="logout.php" class="btn btn-success">logout</a>
            </div>
            <div class="col-sm-8 col-md-8">
                <br><br><br>
                <table class="table table-hover table-striped table-light">
                    <thead>
                    <th>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Usia</td>
                        <td>Prodi</td>
                        <td>Alamat</td>
                        <td>Email</td>
                        <td>Aksi</td>
                    </th>
                    </thead>

                    <?php 

                    $no =1;

                    while($tampil = mysqli_fetch_assoc($query))
                    {
                        $id       =  $tampil['ID']; 
                        $nama     =  $tampil['NAMA'];
                        $alamat   =  $tampil['ALAMAT'];
                        $usia     =  $tampil['USIA'];
                        $email    =  $tampil['email'];
                        $jurusan  =  $tampil['jurusan'];
                    


                    ?>
              

                    <tbody>
                    <th>
                        <td><?php print $no++; ?></td>
                        <td><?php print $nama; ?></td>
                        <td><?php print $usia ?></td>
                        <td><?php print $jurusan; ?></td>
                        <td><?php print $alamat; ?></td>
                        <td><?php print $email; ?></td>
                        <td><a href="backend.php?hapus=<?php print $id; ?>" class="btn btn-danger btn-sm " onclick="return confirm('anda yakin ?')">hapus</a>
                        <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahdata<?php print $id; ?>">edit</a>

                        <!-- Modal -->
                        <div class="modal fade" id="ubahdata<?php print $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Ubah data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <form action="backend.php" method="post" class="form-group">

                                   <input type="hidden" value="<?php print $id; ?>" name="id">
                                   <label for="" class=" form-text form-label">Nama Mahasiswa</label>
                                   <input type="text" name="nama" placeholder="nama kamu" class="form-control" required="" value="<?php print $nama; ?>">
                                   <label for="" class=" form-text form-label">Usia</label>
                                   <input type="text" name="usia" placeholder="Usia" class="form-control" required="" value="<?php print $usia; ?>">
                                   <label for="" class="form-label form-text">Jurusan</label>
                                   <select name="jurusan" id="" class="form-control">
                                    <option value="<?php print $jurusan; ?>"><?php print $jurusan; ?></option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Ilmu komunikasi">Ilmu komunikasi</option>
                                    <option value="Ilmu Komputer">Ilmu Komputer</option>
                                   </select>
                                   <label for="" class=" form-text form-label">Alamat</label>
                                   <input type="text" name="alamat" placeholder="Alamat" class="form-control" required="" value="<?php print $alamat; ?>">
                                   <label for="" class=" form-text form-label">Email aktif</label>
                                   <input type="email" name="email" placeholder="Email" class="form-control" required="" value="<?php print $email; ?>">

                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" name="ubah" value="ubah" class="btn btn-primary">
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- end modal -->
                    </td>
                    </th>


                    <?php }?>

                    </tbody>
                </table>
            </div>
            <div class="col-sm-2 col-md-2"></div>
        </div>
    </div>
</body>
</html>