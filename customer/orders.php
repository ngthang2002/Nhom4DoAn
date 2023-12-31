<?php include('include/header.php');

if (!isset($_SESSION['email'])) {
  header('location:../sign-in.php');
}
?>
<div class="jumbotron bg-secondary">
  <h1 class="text-center text-white mt-5">Đơn đặt hàng của tôi</h1>
</div>

<div class="container mt-5 mb-5">

  <div class="row">

    <div class="col-md-3">
      <?php include('include/sidebar.php'); ?>
    </div>

    <div class="col-md-9">
      <h3>Các đơn hàng:</h3>
      <hr>
      <?php
      $customer_id = $_SESSION['id'];

      $order_query = "SELECT * FROM customer_order  WHERE cust_id=$customer_id";
      $run = mysqli_query($con, $order_query);

      if (mysqli_num_rows($run) > 0) {

        if (isset($_SESSION['message'])) {
        }
      ?>
        <table class="table table-responsive table-hover ">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th width="120px"> Image</th>
              <th>Tên</th>
              <th>Số lượng</th>
              <th>Tổng giá</th>
              <th>Ngày</th>
              <th width="120px">Tình trạng</th>

            </tr>
          </thead>

          <tbody>
            <?php

            while ($order_row = mysqli_fetch_array($run)) {
              $order_id      = $order_row['order_id'];
              $order_pro_id  = $order_row['product_id'];
              $order_qty     = $order_row['quantily'];
              $order_date    = $order_row['date'];
              $order_status  = $order_row['status'];

              $pro_query  = "SELECT * FROM furniture_product WHERE id=$order_pro_id";
              $pro_run    = mysqli_query($con, $pro_query);

              if (mysqli_num_rows($pro_run) > 0) {
                while ($pr_row = mysqli_fetch_array($pro_run)) {
                  $price = $pr_row['price'];
                  $title = $pr_row['title'];
                  $img1 = $pr_row['image'];



            ?>
                  <tr>
                    <td><?php echo $order_id; ?></td>
                    <td>
                      <img src="../img/<?php echo $img1; ?>" width="100%">
                    </td>
                    <td>
                      <h6><?php echo $title; ?></h6>

                    </td>
                    <td>
                      x <?php echo $order_qty; ?>
                    </td>
                    <td><?php echo $order_qty * $price; ?> </td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php
                        if ($order_status == 'pending') {
                          echo "<i class='far fa-exclamation-circle text-warning'></i> $order_status";
                        } else if ($order_status == 'verified') {
                          echo "<i class='far fa-check-circle text-success'></i> $order_status";
                        } else if ($order_status == 'delivered') {
                          echo "<i class='far fa-truck text-primary'></i> $order_status";
                        }
                        ?> </td>

                  </tr>
            <?php
                }
              }
            }
            ?>

          </tbody>
        </table>
      <?php

      } else {
        echo "<h2 class='text-center text-secondary mt-5 mb-5'>Không có đơn hàng nào! </h2>";
      }
      ?>

    </div>
  </div>

</div>



<?php include('include/footer.php'); ?>