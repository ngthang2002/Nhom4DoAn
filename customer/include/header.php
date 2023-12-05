<?php
session_start();
include_once('include/dbcon.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>E-Commerce</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.css.map" rel="stylesheet">
  <link href="css/all.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

  <header>

    <?php
    if (isset($_SESSION['email'])) {
      $cust_id =  $_SESSION['id'];
      $query = "SELECT * FROM cart Where cust_id=$cust_id";
      $run   = mysqli_query($con, $query);

      $count = mysqli_num_rows($run);
    } else {
      $count = 0;
    }
    ?>
    <!--header --->
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
      <a href="../index.php" class="navbar-brand">
        <img src="../img/favicon.png" width="40px" height="40px">Nội thất <sapn class="font-weight-bold">Anh Thư</sapn>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapisblenav" aria-controls="collapsiblenav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapisblenav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="../index.php">Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="../product.php">Sản phẩm</a></li>
          <li class="nav-item"><a class="nav-link" href="../about-us.php">Chúng tôi</a></li>

          <?php

          if (isset($_SESSION['email'])) {


          ?>
            <li class="nav-item ml-5"><a class="nav-link" href="index.php"><i class="far fa-user top-icon"></i> TàiKhoản</a></li>
          <?php }
          ?>
          <li class="nav-item"><a class="nav-link" href="../cart.php"><i class="fal fa-shopping-cart top-icon"></i><span class="badge badge-primary" style="position:absolute; margin-left:-5px;"><?php echo $count; ?> </span></a></li>

        </ul>
      </div>
    </nav>

  </header>