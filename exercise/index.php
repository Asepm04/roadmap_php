<?php

include 'BE.php';
session_start();
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key= $_COOKIE['key'];
    $query = mysqli_query($koneksi,"select email from siswa where ID='$id'");
    $sql   = mysqli_fetch_assoc($query);
    if(hash('sha256',$sql['email'])===$key){
        $_SESSION['status']=true;
    }
}
if(!isset($_SESSION['status'])=="login")
{
    header("location:login.php");
}

$tampil = mysqli_query($koneksi,'select * from siswa'); 

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ujian 11:30 </title>
    <script src="../js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdata">Tambahkan data</a>
                <a href="logout.php" class="btn btn-success">logout</a>

                 <!-- Modal -->
                 <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-secondary">
                                <div class="modal-header bg-secondary">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body bg-dark text-light">
                                   <form action="BE.php" method="post" class="form-group">
                                    <label  class="form-label form-text">Nama</label>
                                    <input type="text" class="form-control" require name="name">
                                    <label  class="form-label form-text">Umur</label>
                                    <input type="text" class="form-control" require name="umur">
                                    <label  class="form-label form-text">Jurusan</label>
                                    <select name="jurusan" id="" class="form-select">
                                        <option value="">jurusan</option>
                                        <option value="teknik informatika">teknik informatika</option>
                                        <option value="ilmu komunikasi">ilmu komunikasi</option>
                                        <option value="sistem informasi">sistem informasi</option>
                                        <option value="ilmu komputer">ilmu komputer</option>
                                    </select>
                                    <label  class="form-label form-text">Alamat</label>
                                    <input type="text" class="form-control" require name="alamat">
                                    <label  class="form-label form-text">Email</label>
                                    <input type="email" class="form-control" require name="email">
                                   
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="tambah" value="tambah" class="btn btn-success">
                                    </form>
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    
                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- end modal -->
            </div>
            <div class="col-sm-8 col-md-8">
                <table class=" table table-hover table-stripped bg-secondary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Jurusan</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                    

                    <?php
                    $no = 1;
                    while($read=mysqli_fetch_array($tampil)){

                    
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $read['NAMA']; ?></td>
                        <td><?php echo $read['USIA']; ?></td>
                        <td><?php echo $read['jurusan']; ?></td>
                        <td><?php echo $read['ALAMAT']; ?></td>
                        <td><?php echo $read['email']; ?></td>
                        <td><a href="BE.php?del=<?php echo $read['ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('anda yakin ingin menghapus ??')">hapus</a>
                        <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editdata<?php echo $read['ID']; ?>" href="">edit</a></td>

                        <!-- Modal -->
                        <div class="modal fade" id="editdata<?php echo $read['ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-secondary">
                                <div class="modal-header bg-secondary">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body bg-dark text-light">
                                   <form action="BE.php" method="post" class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $read['ID']; ?>">
                                    <label  class="form-label form-text">Nama</label>
                                    <input type="text" class="form-control" require name="name" value="<?php echo $read['NAMA']; ?>">
                                    <label  class="form-label form-text">Umur</label>
                                    <input type="text" class="form-control" require name="umur" value="<?php echo $read['USIA']; ?>">
                                    <label  class="form-label form-text">Jurusan</label>
                                    <select name="jurusan" id="" class="form-select">
                                        <option value="<?php echo $read['jurusan']; ?>"><?php echo $read['jurusan']; ?></option>
                                        <option value="teknik informatika">teknik informatika</option>
                                        <option value="ilmu komunikasi">ilmu komunikasi</option>
                                        <option value="sistem informasi">sistem informasi</option>
                                        <option value="ilmu komputer">ilmu komputer</option>
                                    </select>
                                    <label  class="form-label form-text">Alamat</label>
                                    <input type="text" class="form-control" require name="alamat" value="<?php echo $read['ALAMAT']; ?>">
                                    <label  class="form-label form-text">Email</label>
                                    <input type="email" class="form-control" require name="email" value="<?php echo $read['email']; ?>">
                                   
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="edit" value="ubah" class="btn btn-success">
                                    </form>
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    
                                </div>
                                </div>
                            </div>
                        </div>
                            <!-- end modal -->
                    </tr>
                    <?php } ?>
                    
                </table>
            </div>
            <div class="col-sm-2 col-md-2"></div>
            
        </div>
    </div>
</body>
</html>