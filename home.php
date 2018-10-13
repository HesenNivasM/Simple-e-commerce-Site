<?php
  $connection = mysqli_connect('localhost','root','hesennivas','fashion');
    if(mysqli_connect_errno()){
    echo "Failed to connect";
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>WalkByFashion</title>

    <link rel="stylesheet" href="./static/bootstrap/bs-css/bootstrap.min.css">
    <script type="text/javascript" src="./static/bootstrap/bs-js/jquery.min.js"></script>
    <script type="text/javascript" src="./static/bootstrap/bs-js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function incre(id){
          document.getElementById(id).value = parseInt(document.getElementById(id).value)+1;
        }
        function decre(id){
          if(parseInt(document.getElementById(id).value)>0)
          document.getElementById(id).value = parseInt(document.getElementById(id).value)-1;
        }
    </script>
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
                    <?php session_start(); if(!$_SESSION["loggedin"]){ ?>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="./php/login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./php/register.php">Register</a>
                            </li>
                    </ul>
                  <?php } ?>
                  <?php if($_SESSION["loggedin"]){ ?>
                  <ul class="navbar-nav ml-auto">
                      <!-- Authentication Links -->
                          <li class="nav-item">
                              <a class="nav-link" href="./php/logout.php">Logout</a>
                          </li>
                  </ul>
                  <?php } ?>
                </div>
            </div>
        </nav>
        <hr>
    </div>
    <div class="container">
    <?php
      $result =mysqli_query($connection, "select * from stock");
      $temp = 0;
      while ($row = mysqli_fetch_assoc($result))
       {
        $temp = $temp + 1;
        if($temp%3 == 1){
          echo "<div class='row'>";
        }
         echo "<div class='col-4'><div class='card text-center'>
         <img class='card-img-top' src="."./php/".$row['image']." alt='Card image cap'>
         <div class='card-body'>
           <h4>".$row['name']."</h4>
           <p class='card-text'>Type : ".$row['type']."</p>
           <p class='card-text'>Size : ".$row['size']."</p>
           <p class='card-text'>Price : Rs.".$row['price']."</p>";
           if($_SESSION['loggedin']){
               echo "<form action='./php/buy.php' method='POST'>
               <label>Quantity : </label>
               <input name='itemno' type='number' value='".$row['id']."' style='display:none;'>
               <button class='btn btn-default' type='button' onclick='incre(".$row['id'].");'>+</button>
               <input id='".$row['id']."' name='quantity' style='width:50px;' type='number' id='quantity' value=0></input>
               <button class='btn btn-default' type='button' onclick='decre(".$row['id'].");'>-</button>
               <br><br>
               <input class='btn btn-success' type='submit' value='Buy'>
               </form>";
           }
           echo "</div>
        </div></div>";
        if($temp%3 == 0){
          echo "</div><br>";
        }
       }
      mysqli_close($connection);
    ?>
    </div>
</body>
</html>
