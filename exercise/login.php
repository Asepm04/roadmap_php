<?php
session_start();
if(isset($_SESSION['status'])=="login")
{
    header("location:index.php");
}
 

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login|user</title>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-4"></div>
            <div class="col-sm-4 col-md-4">
                <form action="BE.php" method="post" class="form-group">
                    <label for="" class="form-label form-text">Username</label>
                    <input type="text" class="form-control" required="" name="user">
                    <label for="" class="form-label form-text">Password</label>
                    <input type="password" class="form-control" required name="pw" >
                    <label for="label" class=" form-text">remember me</label>
                    <input type="checkbox" class="form-check" name="remember">
                    
                    <input type="submit" class="btn btn-primary d-block form-control" name="login" value="login">
                </form>
            </div>
            <div class="col-sm-4 col-md-4"></div>
        </div>
    </div>
</body>
</html>