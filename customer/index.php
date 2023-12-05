<?php include('include/header.php');

if (!isset($_SESSION['email'])) {
  header('location:../sign-in.php');
}

if (isset($_SESSION['email'])) {

  $customer_id    = $_SESSION['id'];

  $query = "SELECT * FROM customer WHERE cust_id=$customer_id";
  $run   = mysqli_query($con, $query);
  $row = mysqli_fetch_array($run);

  $cust_name = $row['name'];
  $cust_email = $row['email'];
  $cust_add = $row['address'];
  $cust_city = $row['city'];
  $cust_number = $row['phone'];


  if (isset($_POST['update'])) {
    echo "ouahof";
    $fullname = $_POST['fullname'];
    echo $email    = $_POST['email'];
    $address  = $_POST['address'];
    $city     = $_POST['city'];
    $number   = $_POST['phone_number'];

    $up_query = "UPDATE `customer` SET `name`='$fullname',
    `address`='$address',`city`='$city',`phone`='$number' 
     WHERE cust_id=$customer_id ";
    if (mysqli_query($con, $up_query)) {

      $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible fade show pt-1 pb-1 pl-3'  role='alert'>
        Thông tin đã được cập nhât!
        <button type='button' class='close p-2' data-dismiss='alert' aria-label='Close'>
         <span  aria-hidden='true'>&times;</span>
        </button>
         </div>";
      header('location:index.php');
    }
  }
}
?>

<div class="jumbotron bg-secondary">
  <h1 class="text-center text-white mt-5">Tài khoản</h1>
</div>

<div class="container mt-5">
  <div class="row">

    <div class="col-md-3">
      <?php include('include/sidebar.php'); ?>
    </div>

    <div class="col-md-9">
      <h3>Thông tin cá nhân</h3>
      <hr>

      <form method="post" class="w-75">

        <div class="form-group ">
          <input type="text" name="fullname" placeholder="Họ và tên" value="<?php echo $cust_name; ?>" class="form-control">
        </div>

        <div class="form-group">
          <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $cust_email; ?>" disabled>
        </div>


        <div class="form-group">
          <input type="text" name="address" placeholder="Địa chỉ" value="<?php echo $cust_add; ?>" class="form-control">
        </div>

        <div class="row">
          <div class="col-md-12 col-6">
            <div class="form-group">
              <input type="text" name="city" placeholder="Thành phố" value="<?php echo $cust_city; ?>" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <input type="number" name="phone_number" placeholder="Số điện thoại" value="<?php echo $cust_number; ?>" class="form-control">
        </div>

        <div class="form-group text-center mt-4">
          <input type="submit" name="update" class="btn btn-primary" value="Cập nhật">
        </div>

      </form>

    </div>
  </div>
</div>