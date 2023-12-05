<?php include('include/header.php'); ?>

<div class="container sign-in-up">
  <div class="row">
    <div class="col-md-6">
      <h1>Cửa hàng nội thất Anh Thư</h1>
      <p>Một cửa hàng đồ nội thất trực tuyến cho phép người dùng kiểm tra các đồ nội thất khác nhau có sẵn tại cửa hàng trực tuyến và mua hàng trực tuyến. Dự án bao gồm danh mục các sản phẩm nội thất được trưng bày đa dạng về mẫu mã và kiểu dáng. Người dùng có thể duyệt qua các sản phẩm này theo danh mục. Nếu người dùng thích một sản phẩm, họ có thể thêm sản phẩm đó vào giỏ hàng của mình. Khi người dùng muốn thanh toán, anh ta phải đăng ký trên trang web trước. Sau đó anh ta có thể đăng nhập bằng mật khẩu id tương tự vào lần sau.</p>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center mt-5">Đăng ký Tài Khoản</h1>


          <form method="post" class="mt-5 p-3">

            <?php
            if (isset($_POST['register'])) {

              $fullname = $_POST['fullname'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $conf_pass = $_POST['confirm-password'];
              $address = $_POST['address'];
              $city = $_POST['city'];
              $number = $_POST['phone_number'];

              if (!empty($fullname) or !empty($email) or !empty($password) or !empty($conf_pass) or !empty($address) or !empty($city) or !empty($postal_code) or !empty($number)) {

                if ($password === $conf_pass) {

                  $cust_query = "INSERT INTO customer(`name`,`email`,`password`,`address`,`city`,`phone`) VALUES('$fullname','$email','$password','$address','$city','$number')";


                  if (mysqli_query($con, $cust_query)) {
                    $message = "Đăng ký thành công!";
                  }
                } else {
                  $error = "Mật khẩu không hợp lệ!";
                }
              } else {
                $error = "Chưa nhập đủ thông tin!";
              }
            }

            ?>
            <?php
            if (isset($error)) {

              echo "<div class='alert bg-danger' role='alert'>
                                <span class='text-white text-center'> $error</span>
                              </div>";
            } else if (isset($message)) {

              echo "<div class='alert bg-success' role='alert'>
                                <span class='text-white text-center'> $message</span>
                              </div>";
            }

            ?>
            <div class="form-group">

              <input type="text" name="fullname" placeholder="Họ và tên" class="form-control">
            </div>

            <div class="form-group">
              <input type="text" name="email" placeholder="Email" class="form-control">
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-12 col-md-6 ">
                <div class="form-group">
                  <input type="password" name="confirm-password" placeholder="Confirm password" class="form-control">
                </div>
              </div>
            </div>


            <div class="form-group">
              <input type="text" name="address" placeholder="Địa chỉ" class="form-control">
            </div>

            <div class="row">
              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="text" name="city" placeholder="Thành Phố" class="form-control">
                </div>
              </div>

              <!-- <div class="col-md-6 col-6">
                        <div class="form-group">
                          <input type="number" name="code" placeholder="Postal code" class="form-control" >
                       </div>
                      </div> -->

            </div>

            <div class="form-group">
              <input type="number" name="phone_number" placeholder="Số điện thoại" class="form-control">
            </div>

            <div class="form-group text-center mt-4">
              <input type="submit" name="register" class="btn btn-primary" value="Đăng Ký">
            </div>

            <div class="text-center mt-4"> Đã có tài khoản? <a href="sign-in.php"> Đăng Nhập</a></div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>