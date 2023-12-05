<?php include('include/header.php');

if (isset($_SESSION['email'])) {
  $custid = $_SESSION['id'];

  if (isset($_GET['cart_id'])) {
    $p_id = $_GET['cart_id'];

    $sel_cart = "SELECT * FROM cart WHERE cust_id = $custid and product_id = $p_id ";
    $run_cart    = mysqli_query($con, $sel_cart);

    if (mysqli_num_rows($run_cart) == 0) {
      $cart_query = "INSERT INTO `cart`(`cust_id`, `product_id`,quantity) VALUES ($custid,$p_id,1)";
      if (mysqli_query($con, $cart_query)) {
        header('location:index.php');
      }
    }
    if (mysqli_num_rows($run_cart) > 0) {
      while ($row = mysqli_fetch_array($run_cart)) {
        $exist_pro_id = $row['product_id'];
        if ($p_id == $exist_pro_id) {
          $error = "<script> alert('⚠️ This product is already in your cart  ');</script>";
        }
      }
    }
  }
} else if (!isset($_SESSION['email'])) {
  echo "<script> function a(){alert('⚠️ Login is required to add this product into cart');}</script>";
}
?>
<!--Carousel Wrapper-->
<div class="carousel slide mt-5" id="slider" data-ride="carousel">
  <!---Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#slider" data-slide-to="0" class="active"></li>
    <li data-target="#slider" data-slide-to="1"></li>
    <li data-target="#slider" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/noithatanhthu.jpg" class="d-block w-100">

    </div>
    <div class="carousel-item">
      <img src="img/dich-vu-cho-thue-xe.jpg" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="img/thue-xe-Giang-Gia-banner-1024x384.jpg" class="d-block w-100">
    </div>

    <!---Controlers-->
    <a class="carousel-control-prev" data-slide="prev" href="#slider">
      <span class="carousel-control-prev-icon"></span>
    </a>

    <a class="carousel-control-next" href="#slider" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>

  </div>

</div>
<!--/.Carousel Wrapper-->



<!--Latest product---->
<section>
  <div class="container pt-5 pb-5">
    <div>
      <?php
      if (isset($msg)) {
        echo $msg;
      } else if (isset($error)) {
        echo $error;
      }
      ?>
    </div>

    <h1 class="text-center">Sản phẩm mới nhất</h1>

    <div class="row mt-4">

      <?php
      $p_query = "SELECT * FROM furniture_product ORDER BY id DESC LIMIT 4";
      $p_run   = mysqli_query($con, $p_query);

      if (mysqli_num_rows($p_run) > 0) {
        while ($p_row = mysqli_fetch_array($p_run)) {
          $pid      = $p_row['id'];
          $ptitle  = $p_row['title'];
          $pcat    = $p_row['category'];
          $p_price = $p_row['price'];

          $img1    = $p_row['image'];
      ?>

          <div class="col-md-3 mt-3">
            <img src="img/<?php echo $img1; ?>" class="hover-effect" width="100%" height="190px">
            <div class="text-center mt-3">
              <h5 title="<?php echo $ptitle; ?>"><?php echo substr($ptitle, 0, 20); ?>...</h5>
              <h6>đ.<?php echo $p_price; ?></h6>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-12 text-center">

                <a href="product-detail.php?product_id=<?php echo $pid; ?>" class="btn btn-default btn-sm hover-effect text-dark">
                  <i class="far fa-info-circle"></i> Chi tiết
                </a>

              </div>

            </div>
          </div>

      <?php
        }
      } else {
        echo "<h3 class='text-center'> No Product Available Yet </h3>";
      }

      ?>

    </div>
  </div>
</section>
<!---end latest Products-->

<!---We deal with-->
<section class="bg-white">
  <div class="container pt-4 pb-5">
    <h1 class="text-center pt-4">Blog </h1>

    <!---Row 1-->
    <div class="row mt-5">
      <div class="col-md-4">
        <img src="img/bedset.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Giường ngủ hiện đại</h4>
          <p class="text-center">Chúng tôi cung cấp các bộ giường ngủ hiện đại được làm từ gỗ công nghiệp kết hợp với lớp gỗ tự nhiên. Sản phẩm của chúng tôi có giá cả phải chăng nhưng chất lượng cao.</p>
        </div>
      </div>
      <div class="col-md-4">
        <img src="img/dining-set.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Cung cấp bộ bàn ăn hiện đại</h4>
          <p class="text-center">Sản phẩm của chúng tôi mang đến sự sang trọng và phong cách, với thiết kế rất hiện đại và tinh tế. Bàn ăn được xây dựng từ gỗ chắc chắn và bền bỉ.</p>
        </div>
      </div>

      <div class="col-md-4">
        <img src="img/chairyellow.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Thiết kế ghế tựa</h4>
          <p class="text-center">Sản phẩm của chúng tôi mang đến sự sang trọng và phong cách, với thiết kế rất hiện đại và tinh tế. Các ghế tựa được xây dựng từ gỗ chắc chắn và bền bỉ.</p>
        </div>
      </div>

    </div>
    <!---end-->

    <!---row 2-->
    <div class="row mt-5">
      <div class="col-md-4">
        <img src="img/table.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Các mẫu bàn mới nhất</h4>
          <p class="text-center">Sản phẩm của chúng tôi mang đến sự sang trọng và phong cách, với thiết kế rất tinh tế và hiện đại. Chúng được chế tạo từ gỗ chắc chắn và bền bỉ.</p>
        </div>
      </div>
      <div class="col-md-4">
        <img src="img/modern-contemp.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Mẫu sofa/ghế sofa hiện đại</h4>
          <p class="text-center">Sản phẩm của chúng tôi có thiết kế rất tinh tế và hiện đại, mang đến vẻ đẹp sang trọng và phong cách. Chúng được chế tạo từ gỗ chắc chắn và bền bỉ.</p>
        </div>
      </div>

      <div class="col-md-4">
        <img src="img/newcupboard.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Tủ quần áo hiện đại, sang trọng</h4>
          <p class="text-center">Tủ quần áo tích hợp được xem như một không gian lưu trữ là một phần của thiết kế của căn phòng. Chúng tạo điểm nhấn và mang lại sự tiện ích cho không gian lưu trữ.</p>
        </div>
      </div>

    </div>

  </div>
</section>
<!--end deal with-->

<!---How to Shop -->
<section class="back-gray pt-4 pb-4">
  <div class="container">
    <h2 class="text-center">Nó hoạt động như thế nào</h2>
    <div class="row">

      <!--choose product card-->
      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-phone-laptop fa-3x"></i>
            <div class="heading mt-2">
              <h4>Product</h4>
              <h6 class="text-secandary">Chọn một sản phẩm</h6>
            </div>
            <p class="mt-2">Thêm sản phẩm vào giỏ hàng và tiến hành thanh toán, sau đó nhập địa chỉ giao hàng của bạn và hoàn tất thanh toán. </p>

          </div>
        </div>
      </div>
      <!---end choose product-->


      <!--cash on deliver-->
      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-hand-holding-box fa-3x"></i>
            <div class="heading mt-2">
              <h4>Recieve</h4>
              <h6 class="text-secandary">Nhận sản phẩm của bạn</h6>
            </div>
            <p class="mt-2">Sau khi mua hàng, sản phẩm của bạn sẽ được giao đến tận nhà.</p>

          </div>
        </div>
      </div>
      <!---end cash on delivery-->


      <!--cash on deliver-->
      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-wallet fa-3x"></i>
            <div class="heading mt-2">
              <h4>Cash</h4>
              <h6 class="text-secandary">Thanh toán khi nhận hàng</h6>
            </div>
            <p class="mt-2">Khi nhận sản phẩm của bạn, bạn có thể giữ hoặc nhận sản phẩm và sau đó thanh toán bằng tiền mặt tại thời điểm đó.</p>

          </div>
        </div>
      </div>
      <!---end cash on delivery-->

    </div>
  </div>
</section>
<!---end How to shop-->