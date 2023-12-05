<?php
require_once('include/header.php');
if (!isset($_SESSION['email'])) {
  header('location: signin.php');
}
if (isset($_SESSION['email'])) {
  $session_id = $_SESSION['id'];
  $session_email = $_SESSION['email'];
  $session_name = $_SESSION['name'];
}
?>



<div class="container-fluid mt-2">
  <script src="ckeditor/ckeditor.js"></script>
  <div class="row">
    <div class="col-md-3 col-lg-3">
      <?php require_once('include/sidebar.php'); ?>
    </div>

    <div class="col-md-9 col-lg-9">
      <form method="post" enctype="multipart/form-data">
        <?php
        if (isset($_GET['order_id'])) {
          $fur_order_id = $_GET['order_id'];
          $order_query = "SELECT order_id, customer_order.cust_id, email, product_id, quantily, customer_order.date, price, customer_order.status 
                            FROM customer_order inner join furniture_product on customer_order.product_id = furniture_product.id 
                            inner join customer on customer_order.cust_id = customer.cust_id WHERE customer_order.order_id='$fur_order_id' ORDER BY order_id";
          $run = mysqli_query($con, $order_query);

          if (mysqli_num_rows($run) > 0) {
            $order_row = mysqli_fetch_array($run);
            $order_id      = $order_row['order_id'];
            $cust_id       = $order_row['cust_id'];
            $cust_email    = $order_row['email'];
            $order_pro_id  = $order_row['product_id'];
            $order_qty     = $order_row['quantily'];
            $price         = $order_row['price'];
            $order_amount  = $order_qty * $price;
            $order_date    = $order_row['date'];
            $order_status  = $order_row['status'];

            $pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id WHERE fp.id = $order_pro_id ";
            $pr_run   = mysqli_query($con, $pr_query);

            if (mysqli_num_rows($pr_run) > 0) {
              $pr_row = mysqli_fetch_array($pr_run);
              $pid   = $pr_row['id'];
              $image = $pr_row['image'];
              $category = $pr_row['category'];


              if (isset($_POST['update'])) {
                $status     = $_POST['status'];

                if (!empty($status)) {
                  $query = "UPDATE customer_order SET `status`='$status' WHERE order_id=$order_id";
                  if (mysqli_query($con, $query)) {
                    if ($status == 'pending') {
                      header("location:pending_furniture_pro.php");
                    } else if ($status == 'verified') {
                      header("location:verified_furniture_pro.php");
                    } else if ($status == 'delivered') {
                      header("location:delivered_furniture_pro.php");
                    }
                  }
                }
              }
              if (isset($msg)) {
                echo "<span class='mt-3 mb-5' style='color:green; font-weight:bold;'><i style='color:green; font-weight:bold;' class='fas fa-smile'></i> $msg</span>";
              } ?>
              <div class="row">


                <div class="col-md-3">
                  <div class="form-group">
                    <label for="furniture">ID Đơn hàng:</label>
                    <input type="text" class="form-control" value="<?php echo $order_id; ?>" disabled>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="furniture">ID Sản phẩm:</label>
                    <input type="text" class="form-control" value="<?php echo $order_pro_id; ?>" disabled>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="furniture">Danh mục:</label>
                    <input type="text" class="form-control" value="<?php echo  $category; ?>" disabled>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-3">
                  <label for="category">ID Khách hàng:</label>
                  <input type="text" class="form-control" value="<?php echo $cust_id ?>" disabled>

                </div>
                <!-- Grid column -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="size">Email:</label>
                    <input type="text" class="form-control" value="<?php echo $cust_email ?>" disabled>
                  </div>
                </div>
                <!-- Grid column -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="size">Giá:</label>
                    <input type="text" class="form-control" value="<?php echo $order_amount ?>" disabled>
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="size">Số lượng:</label>
                  <input type="disabled" class="form-control" value="<?php echo $order_qty; ?>" disabled>
                </div>

              </div>


              <div class="row mt-3">

                <div class="col-md-6">
                  <span>Trạng thái</span>
                  <select class="form-control" name="status">
                    <?php if ($order_status == 'pending') {
                      echo "<option value='pending'  selected >Pending</option>";
                      echo "<option value='verified'>Verified</option>";
                    } else if ($order_status == 'verified') {
                      echo "<option value='verified'  selected >Verified</option>";
                      echo "<option value='pending'>Pending</option>";
                      echo "<option value='delivered'>Delivered</option>";
                    }


                    ?>

                  </select>
                </div>

                <div class="col-md-6">
                  <img src="img/<?php echo $image; ?>" min-width="100%" height="200px">
                </div>
              </div>
          <?php

            }
          }
          ?>
          <input type="submit" name="update" class=" mt-3 btn btn-primary btn-md" value="Update">
        <?php
        }
        ?>
      </form>
    </div>

  </div>