<?php
if(isset($_POST['submit'])){
    session_start();
    $db = mysqli_connect('localhost','root','hesennivas','fashion');
    $un = $_POST['username'];
    $pswd = $_POST['password'];
    $pswd2 = $_POST['password2'];
    $phnno = $_POST['phoneno'];
    $sql = mysqli_query($db,"SELECT username FROM users WHERE username='$un'");
    if (!$sql) {
       printf("Error: %s\n", mysqli_error($db));
       exit();
    }
    $row = mysqli_fetch_array($sql);
    $db_username = $row['username'];
    $usernames = $db_username;
    $data = 1;
    if( isset($un) ) {
     if ($un == $usernames )  {
       echo "<script>alert('Username not available!');</script>";
       $data = 0;
      }
     }
    if( isset($pswd) && isset($pswd2) ) {
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pswd)) {
       echo "<script>alert('Passwords do not meet the requirements!');</script>";
       $data = 0;
      }
     else if( $pswd2 != "" && $pswd != $pswd2 ) {
       echo "<script>alert('Passwords do not match!');</script>";
       $data = 0;
      }
     }
     if($data){
     $pswd = password_hash($pswd, PASSWORD_DEFAULT);
     $pswd2 = password_hash($pswd2, PASSWORD_DEFAULT);
     $stmt = mysqli_query($db,"INSERT INTO users (username,phoneno,password) VALUES ('$un','$phnno','$pswd')");
     if (!$stmt) {
       printf("Error: %s\n", mysqli_error($db));
       exit();
     }
     header("Location: ./login.php");
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
                <a class="navbar-brand" href="../">
                    Walk By Fashion
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                </div>
            </div>
        </nav>
        <hr>
    </div>
    <br><br>
    <div class="text-center">
      <h3>Registration</h3>
    </div>
    <br><br>
    <div class="container form-group alert alert-dark">
      <br>
      <form class="form-group" action="" method="post">
      <div class="row">
        <div class="col-4">
          <label class="float-right" for="username">Username</label>
        </div>
        <div class="col-8">
          <input class="form-control" type="text" name="username">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-4">
          <label class="float-right" for="phoneno">Mobile Number</label>
        </div>
        <div class="col-8">
          <input class="form-control" type="number" name="phoneno">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-4">
          <label class="float-right" for="password">Password</label>
        </div>
        <div class="col-8">
          <input class="form-control" type="password" name="password">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-4">
          <label class="float-right" for="password">Confirm Password</label>
        </div>
        <div class="col-8">
          <input class="form-control" type="password" name="password2">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-5"></div>
        <input class="btn btn-primary" type="submit" name="submit" value="Sign Up">
      </div>
    </form>
    </div>
</body>
</html>
