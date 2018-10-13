<?php
  $connection = mysqli_connect('localhost','root','hesennivas','fashion');
    if(mysqli_connect_errno()){
    echo "Failed to connect";
  }
  session_start();
  $result =mysqli_query($connection, "select * from stock WHERE id =".$_POST['itemno']);
  $row = mysqli_fetch_assoc($result);
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

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="./php/logout.php">Logout</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        <hr>
    </div>
    <br>
    <br>
    <div class="container">
    <div class="card">
      <br>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-4">
          <img src="<?php echo $row['image']; ?>">
        </div>
        <div class="col-1"></div>
        <div class="col-3">
          <p>Name : <?php echo $row['name']; ?></p>
          <p>Type : <?php echo $row['type']; ?></p>
          <p>Size : <?php echo $row['size']; ?></p>
          <p>Price : Rs.<?php echo $row['price']; ?></p>
          <p>Quantity : <?php echo $_POST['quantity']; ?></p>
          <?php $total_price = $_POST['quantity']*$row['price']; ?>
          <p>Total Price : Rs.<?php echo $total_price; ?></p>
        </div>
        <div class="col-2"></div>
      </div>
      <br>
      <form class="form-group" action="./order.php" method="post">
        <input type="number" name="itemno" value="<?php echo $_POST['itemno']; ?>" style="display:none;">
        <input type="number" name="quantity" value="<?php echo $_POST['quantity']; ?>" style="display:none;">
        <div class="row">
        <div class="col-5">
          <span class="float-right">Delivery Address :</span>
        </div>
        <div class="col-7">
          <textarea name="address" rows="6" cols="80"></textarea>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-5"></div>
        <input class="btn btn-success" type="submit" name="order" value="Order">
      </div>
      </form>
      <br>
    </div>
  </div>
</body>
</html>
