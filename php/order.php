<?php
  $connection = mysqli_connect('localhost','root','hesennivas','fashion');
    if(mysqli_connect_errno()){
    echo "Failed to connect";
  }
  session_start();
  $itemno = $_POST['itemno'];
  $quantity = $_POST['quantity'];
  $address = $_POST['address'];
  if(isset($_POST['order'])){
    $query="INSERT INTO orders(itemno,quantity,address) VALUES('$itemno','$quantity','$address')";
    $result = mysqli_query($connection,$query);
    $query1 = "SELECT * FROM stock WHERE id = ".$itemno;
    $result1 = mysqli_query($connection,$query1);
    $row = mysqli_fetch_assoc($result1);
    $value = $row['noofpieces']-$_POST['quantity'];
    mysqli_query($connection,"UPDATE stock SET noofpieces = '$value' WHERE id = '$itemno'");
    header('Location: ../home.php');
  }
?>
