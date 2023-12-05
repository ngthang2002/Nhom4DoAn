<?php include("include/header.php");
if (!isset($_SESSION['email'])) {
  header('location: signin.php');
}
?>

<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-md-3">
      <?php include("include/sidebar.php"); ?>
    </div>

    <div class="col-md-9">

      <div class="row">
        <div class="col-md-1">
          <i class="fad fa-truck fa-6x text-primary"></i>
        </div>
        <div class="col-md-11 text-left mt-4">
          <h1 class="ml-5 display-4 font-weight-normal">Delivered Orders:</h1>
        </div>
      </div>
      <hr>

      <table class="table table-responsive table-hover ">
        <thead class="thead-light">
          <tr>
            <th>ID Đơn hàng</th>
            <th>ID Sản phẩm</th>
            <th>Image</th>
            <th>Danh mục</th>
            <th>ID Khach hang</th>
            <th>Email</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Ngày</th>


          </tr>
        </thead>
        <tbody class="text-center">
          <?php
          $order_query = "SELECT order_id, customer_order.cust_id, email, product_id, quantily, customer_order.date, price, customer_order.status 
                                     FROM customer_order inner join furniture_product on customer_order.product_id = furniture_product.id 
                                     inner join customer on customer_order.cust_id = customer.cust_id ORDER BY order_id";
          $run = mysqli_query($con, $order_query);

          if (mysqli_num_rows($run) > 0) {
            while ($order_row = mysqli_fetch_array($run)) {
              $order_id      = $order_row['order_id'];
              $cust_id       = $order_row['cust_id'];
              $cust_email    = $order_row['email'];
              $order_pro_id  = $order_row['product_id'];
              $price         = $order_row['price'];
              $order_qty     = $order_row['quantily'];
              $order_amount  = $order_qty * $price;
              $order_date    = $order_row['date'];
              $order_status  = $order_row['status'];

              $pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id WHERE fp.id = $order_pro_id ";
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

                    <td><?php echo "<i class='fad fa-truck text-primary'></i> " . ucfirst($order_status); ?></td>
                    <td><?php echo $order_date; ?></td>
                  </tr>
          <?php
                }
              }
            }
          } else {
            echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>You have not delivered any order</h2></td></tr>";
          }



          ?>


        </tbody>
        </form>
      </table>

    </div>



  </div>
</div>