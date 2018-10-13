<?php
  $connection = mysqli_connect('localhost','root','hesennivas','fashion');
    if(mysqli_connect_errno()){
    echo "Failed to connect";
  }
  if(isset($_POST['submit'])){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "<div class='container'><div class='alert alert-success'>The file ". basename( $_FILES["image"]["name"]). " has been uploaded.</div></div>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $name=mysqli_real_escape_string($connection,$_POST['name']);
    $type=mysqli_real_escape_string($connection,$_POST['type']);
    $image=mysqli_real_escape_string($connection,$target_file);
    $noofpieces=mysqli_real_escape_string($connection,$_POST['noofpieces']);
    $size=mysqli_real_escape_string($connection,$_POST['size']);
    $price=mysqli_real_escape_string($connection,$_POST['price']);
    $query="INSERT INTO stock(name,type,noofpieces,image,price,size) VALUES('$name','$type','$noofpieces','$image','$price','$size')";
    $result = mysqli_query($connection,$query);
    echo $result;
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
                </div>
            </div>
        </nav>
        <hr>
    </div>
    <br><br>
    <div class="container form-group card">
      <form action="" method="post" enctype="multipart/form-data">
      <br>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
          <label class="float-right" for="name">Name</label>
        </div>
        <div class="col-1"></div>
        <div class="col-6">
          <input class="form-control" type="text" name="name">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
          <label class="float-right" for="type">Type of Dress</label>
        </div>
        <div class="col-1"></div>
        <div class="col-6">
          <select class="form-control" name="type">
            <option value="Sari and wrapped garments">Sari and wrapped garments</option>
            <option value="Salwaar Kameez">Salwaar Kameez</option>
            <option value="Churidaar">Churidaar</option>
            <option value="Lehenga Choli">Lehenga Choli</option>
            <option value="Sherwani">Sherwani</option>
          </select>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
          <label class="float-right" for="image">Image</label>
        </div>
        <div class="col-1"></div>
        <div class="col-6">
          <input type="file" name="image">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
          <label class="float-right" for="noofpieces">Number Of Pieces</label>
        </div>
        <div class="col-1"></div>
        <div class="col-6">
          <input class="form-control" type="number" name="noofpieces">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
          <label class="float-right" for="size">Size</label>
        </div>
        <div class="col-1"></div>
        <div class="col-6">
          <input class="form-control" type="number" name="size">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
          <label class="float-right" for="price">Price in Rupees</label>
        </div>
        <div class="col-1"></div>
        <div class="col-6">
          <input class="form-control" type="number" name="price">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-1">
            <input class="btn btn-default" type="submit" name="submit" value="Enter">
        </div>
        <div class="col-7"></div>
      </div>
    </form>
    </div>
    <br>
    <h3 class="text-center">Orders</h3>
    <br><br>
      <?php
        $result =mysqli_query($connection, "select * from orders");
        $temp = 0;
        while ($row = mysqli_fetch_assoc($result)){
           echo "<div class='container'><div class='card text-center'>
           <p>Order No:".$row['itemno']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantity:".$row['quantity']."<p>
           </div></div><br><br>";
         }
       ?>
</body>
</html>
