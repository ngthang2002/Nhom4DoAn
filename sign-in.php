<?php
include('include/header.php'); ?>

<div class="container sign-in-up">
  <div class="row mb-5">
    <div class="col-md-6">
      <h1>Cửa hàng nội thất Anh Thư</h1>
      <p>Một cửa hàng đồ nội thất trực tuyến cho phép người dùng kiểm tra các đồ nội thất khác nhau có sẵn tại cửa hàng trực tuyến và mua hàng trực tuyến. Dự án bao gồm danh mục các sản phẩm nội thất được trưng bày đa dạng về mẫu mã và kiểu dáng. Người dùng có thể duyệt qua các sản phẩm này theo danh mục. Nếu người dùng thích một sản phẩm, họ có thể thêm sản phẩm đó vào giỏ hàng của mình. Khi người dùng muốn thanh toán, anh ta phải đăng ký trên trang web trước. Sau đó anh ta có thể đăng nhập bằng mật khẩu id tương tự vào lần sau.</p>
    </div>


    <div class="col-md-6" style="height:66.5vh;">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center mt-5">Đăng Nhập</h1>

          <form method="post" class="mt-5 p-3">

            <?php if (isset($_POST['signin'])) {
              $email     = mysqli_real_escape_string($con, $_POST['email']);
              $password  = mysqli_real_escape_string($con, $_POST['password']);

              $query = "SELECT * FROM customer";
              $run   = mysqli_query($con, $query);

              if (mysqli_num_rows($run) > 0) {
                while ($row = mysqli_fetch_array($run)) {

                  $db_cust_id    = $row['cust_id'];
                  $db_cust_name  = $row['name'];
                  $db_cust_email = $row['email'];
                  $db_cust_pass  = $row['password'];
                  $db_cust_add   = $row['address'];
                  $db_cust_city  = $row['city'];
                  $db_cust_number = $row['phone'];

                  if ($email == $db_cust_email && $password == $db_cust_pass) {
                    $_SESSION['id']    = $db_cust_id;
                    $_SESSION['name']  = $db_cust_name;
                    $_SESSION['email'] = $db_cust_email;
                    $_SESSION['add']   = $db_cust_add;
                    $_SESSION['city']  = $db_cust_city;
                    $_SESSION['number'] = $db_cust_number;

                    header('location:customer/index.php');
                  } else {
                    $error = "Email hoặc Password không hợp lệ!";
                  }
                }
              } else {
                $error = "Tài khoản không tồn tại!";
              }
            }

            ?>

            <?php
            if (isset($error)) {

              echo "<div class='alert bg-danger' role='alert'>
                                <span class='text-white text-center'> $error</span>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                              </div>";
            }

            ?>


            <div class="form-group">
              <input type="text" name="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>

            <a href="#"> Quên mật khẩu?</a>

            <div class="form-group text-center mt-4">
              <input type="submit" name="signin" class="btn btn-primary" value="Sign in">
            </div>

            <div class="text-center mt-4"> Chưa có tài khoản? <a href="register.php"> Đăng ký </a></div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>