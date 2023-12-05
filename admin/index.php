<?php

include('include/header.php');

if (!isset($_SESSION['email'])) {
  header('location:signin.php');
}
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}

?>
<div class="container-fluid mt-2">
  <div class="row">
    <!---sidenavbar Column-->
    <div class="col-md-3 col-lg-3">
      <?php require_once('include/sidebar.php'); ?>
    </div>
    <!---Main Column -->
    <div class="col-md-9 col-lg-9">
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-shopping-cart fa-2x"></i>
              </div>
              <?php
              $query = "SELECT * FROM customer_order WHERE `status`='pending'";
              $run   = mysqli_query($con, $query);
              $num_new_orders = mysqli_num_rows($run);
              ?>
              <div class="mr-5"> <span style="font-size:24px;"><?php echo $num_new_orders; ?></span> đơn đặt hàng đang chờ xử lý</div>

            </div>
            <a class="card-footer text-white clearfix small z-1" href="pending_furniture_pro.php">
              <span class="float-left">Chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-truck fa-2x"></i>
              </div>
              <div class="mr-5">
                <?php
                $query = "SELECT * FROM customer_order WHERE `status`='delivered'";
                $run   = mysqli_query($con, $query);
                $num_delivered_orders = mysqli_num_rows($run);
                ?>
                <span style="font-size:24px;"><?php echo $num_delivered_orders; ?> </span> đơn hàng đã giao
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="delivered_furniture_pro.php">
              <span class="float-left">Chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-fw fa-users fa-2x"></i>
              </div>
              <div class="mr-5">
                <?php
                $query = "SELECT * FROM customer";
                $run   = mysqli_query($con, $query);
                $num_customer = mysqli_num_rows($run);
                ?>
                <span style="font-size:24px;"><?php echo $num_customer; ?></span> khách hàng
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="customers.php">
              <span class="float-left">Chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-sack fa-2x"></i>
              </div>
              <div class="mr-5">
                <?php
                // $query = "SELECT SUm(product_amount) as 'earn' FROM customer_order";
                // $run   = mysqli_query($con, $query);
                // $row = mysqli_fetch_array($run);
                // $earning = $row['earn'];

                ?>
                <!-- <span style="font-size:24px;"><?php echo $earning; ?></span> .Đ -->
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>


      <!-- DataTables Example -->
      <h3 class="mt-5">Đơn hàng mới:</h3>
      <table class="table table-responsive table-hover mt-3">
        <thead class="thead-light">
          <tr>
            <th>ID Đơn hàng</th>
            <th>ID Sản phẩm</th>
            <th>Image</th>
            <th>Danh mục</th>
            <th>IDKH</th>
            <th>Email</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>Ngày </th>
            <th>Xác minh</th>


          </tr>
        </thead>
        <tbody class="text-center">
          <?php

          $order_query = "SELECT order_id, customer_order.cust_id, email, product_id, quantily, customer_order.date, price, customer_order.status 
          FROM customer_order inner join furniture_product on customer_order.product_id = furniture_product.id 
          inner join customer on customer_order.cust_id = customer.cust_id WHERE customer_order.status='pending' ORDER BY order_id LIMIT 5;";
          $run = mysqli_query($con, $order_query);

          if (mysqli_num_rows($run) > 0) {
            while ($order_row = mysqli_fetch_array($run)) {
              $order_id      = $order_row['order_id'];
              $cust_id       = $order_row['cust_id'];
              $cust_email    = $order_row['email'];
              $order_pro_id  = $order_row['product_id'];
              $order_qty     = $order_row['quantily'];
              $price         = $order_row['price'];
              $order_amount  = $order_qty * $price;
              $order_date    = $order_row['date'];
              $order_status  = $order_row['status'];

              $pr_query = "SELECT * FROM furniture_product INNER JOIN categories ON furniture_product.category = categories.id 
                WHERE furniture_product.id =  $order_pro_id ";
              $pr_run   = mysqli_query($con, $pr_query);

              if (mysqli_num_rows($pr_run) > 0) {
                while ($pr_row = mysqli_fetch_array($pr_run)) {
                  $pid   = $pr_row['id'];
                  $image = $pr_row['image'];
                  $category = $pr_row['category'];

          ?>
                  <tr>

                    <td>
                      <?php echo $order_id; ?>
                    </td>
                    <td>
                      <?php echo $order_pro_id; ?>
                    </td>
                    <td width="120px">
                      <img src="img/<?php echo $image; ?>" width="100%">
                    </td>
                    <td>
                      <?php echo $category; ?>
                    </td>
                    <td>
                      <?php echo $cust_id; ?>
                    </td>
                    <td>
                      <?php echo $cust_email; ?>
                    </td>
                    <td>
                      <?php echo $order_amount; ?>
                    </td>

                    <td><?php echo $order_qty; ?></td>

                    <td><?php echo $order_date; ?></td>
                    <td><a href="pending_furniture_pro.php"><button class="btn btn-primary btn-sm">Verify order</button></td>
                  </tr>
          <?php
                }
              }
            }
          } else {
            echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>You have not any pending order</h2></td></tr>";
          }



          ?>


        </tbody>
      </table>

      <h3 class="mt-5">Khách hàng mới:</h3>
      <table class="table table-responsive table-hover mt-3">
        <thead class="thead-light">
          <tr>
            <th>#Id</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Thành phố</th>
            <th>Xem chi tiết</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM customer ORDER BY cust_id DESC LIMIT 5";
          $run   = mysqli_query($con, $query);

          if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_array($run)) {
              $cust_id         = $row['cust_id'];
              $cust_name       = $row['name'];
              $cust_email      = $row['email'];
              $cust_city       = $row['city'];

          ?>
              <tr>
                <td>
                  <?php echo $cust_id; ?>
                </td>

                <td width="150px">
                  <?php echo $cust_name; ?>
                </td>

                <td>
                  <?php echo $cust_email; ?>
                </td>

                <td>
                  <?php echo $cust_city ?>
                </td>
                <td><a href="customers.php"><button class="btn btn-primary btn-sm">Chi tiết</button></td>

              </tr>
          <?php
            }
          } else {
            echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>No Registered Customer Yet</h2></td></tr>";
          }
          ?>

        </tbody>
      </table>

    </div>
  </div>
</div>