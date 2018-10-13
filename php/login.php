<?php
  $connection = mysqli_connect('localhost','root','hesennivas','fashion');
  if(mysqli_connect_errno()){
    echo "Failed to connect";
  }
  if(isset($_POST['submit'])){
    $username=mysqli_real_escape_string($connection,$_POST['username']);
    $password=mysqli_real_escape_string($connection,$_POST['password']);

    $query="SELECT * FROM users WHERE username='$username'";

    $result = mysqli_query($connection,$query);

    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if (password_verify ($password ,$row['password'] )){
        echo "Login Successful";
        session_start();
        $_SESSION['loggedin'] = 1;
        header('Location: ../home.php');
    }else{
      echo "<script>alert('Enter valid details');</script>";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>WalkByFashion</title>

    <link rel="stylesheet" href="../static/bootstrap/bs-css/bootstrap.min.css">
    <script type="text/javascript" src="../static/bootstrap/bs-js/jquery.min.js"></script>
    <script type="text/javascript" src="../static/bootstrap/bs-js/bootstrap.min.js"></script>

</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="./">
                    Walk By Fashion
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                </div>
            </div>
        </nav>
        <hr>
    </div>
    <br><br>
    <div class="text-center">
    <h3>Log</h3>
    </div>
    <br><br>
    <div class="container form-group alert alert-dark">
      <br>
      <form class="form-group" action="" method="post">
      <div class="row">
        <div class="col-4">
          <label class="float-right" for="username">Username</label>
        </div>
        <div class="col-6">
          <input class="form-control" type="text" name="username">
        </div>
        <div class="col-2">    </div>
      </div>
      <br>
      <div class="row">
        <div class="col-4">
          <label class="float-right" for="password">Password</label>
        </div>
        <div class="col-6">
          <input class="form-control" type="password" name="password">
        </div>
      </div>
      <div class="col-2"></div>
      <br>
      <div class="row">
        <div class="col-6"></div>
        <input class="btn btn-primary" type="submit" name="submit" value="Log In">
      </div>
    </form>
    </div>
</body>
</html>
