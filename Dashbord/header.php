<?php
session_start();
if (isset($_SESSION['loginstatus'])) {
    if ($_SESSION['loginstatus'] == true) {
    } else {
        header("Location: ../login.php");
    }
} else {
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/style.css">
    <title>Document</title>
</head>
<body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-dark justify-content-between container">
  <a class="navbar-brand" href="../">
    <img src="https://image.shutterstock.com/image-vector/fun-people-healthy-life-logo-260nw-560428081.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
    ShopMake
  </a>

    <div class="navbar-nav">
        <a class="nav-item nav-link active" href="./">UpdateProfile</a>
        <?php if(isset($_SESSION['hasshop']))
        {
            if($_SESSION['hasshop'])
            {
        ?>
        <a class="nav-item nav-link active" href="./addproduct.php">Add Product</a>
        <?php }}?>
        
        <a class="nav-item nav-link active" href="./logout.php">Log out</a>
    </div>
  
</nav>