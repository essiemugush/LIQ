<?php
error_reporting(0);
include('inc/connect.php');
include('prod_edit.php');
if (!isset($_SESSION['email'])) {
  echo "<script>
    location.assign('Login/login.php');
    </script>";
} else {
  $email = $_SESSION['email'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CART</title>
  <!-- Bootstrap ONE-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->

  <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">

  <!-- ===========LINKS 2================ -->
  <!-- Vendor CSS Files -->
  <link href="theme/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="theme/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="theme/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="theme/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="theme/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="theme/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS Files -->
  <link href="theme/assets/css/style.css" rel="stylesheet" media="all">
  <link href="theme/assets/css/footer.css" rel="stylesheet" media="all">
  <link rel="stylesheet" href="theme/assets/css/all.css" media="all">
  <link rel="stylesheet" href="theme/assets/css/heros.css" media="all">

  <style>
    /* ---------WHATSUP ICON ANIMATION */
    .whatsup {
      color: rgb(18, 236, 109);
      background: transparent;
      padding: 12px;
      text-align: center;
      border-radius: 50%;
      position: fixed;
      left: 40px;
      bottom: 5px;
      cursor: pointer;
      transition: opacity 0.5s;

      animation: scaleup 4s ease-in-out infinite;
    }

    @keyframes scaleup {
      0% {
        transform: scale(1.3);
      }

      50% {
        transform: scale(1);
      }

      100% {
        transform: scale(1.3);
      }
    }

    #hero .carousel-indicators li.active {
      opacity: 1;
      background: orangered !important;
    }
  </style>
</head>

<body>
  <?php
  // require 'menu.php';
  require_once "header2.php";
  ?>

  <!--ADDING CUSTOMER PAYMENT DETAILS IN THE DATABASE Modal -->
  <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">PAY FOR YOUR ORDER</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Enter Your Name </label>
              <input type="text" name="nme" class="form-control" id="nme" placeholder="Enter your Name" required>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Enter PHone </label>
              <input type="number" name="account_no" class="form-control" id="account_no" placeholder="Enter your Phone" required>
            </div>

            <div class="form-group">
              <!-- <label for="exampleInputEmail1">Enter Amount</label> -->
              <input type="hidden" name="amount" value="<?php echo $grand_total; ?>" disabled class="form-control" id="amount" placeholder="Enter Amount" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="insert_data" class="btn btn-block btn-primary">PAY ORDER</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <section class="cart_container">

    <div class="shopping_cart" id="shop_cart">
      <h1 style="font-size: 30px;">CART</h1>
      <table>
        <thead>
          <th>Product</th>
          <th>Category</th>
          <th>price</th>
          <th>Sub Total</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php
          $grand_total = 0;
          $id = "";
          $cart_select = "SELECT * FROM cart where email= '$email'";
          $cart_query = mysqli_query($db, $cart_select);
          if (mysqli_num_rows($cart_query) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
          ?>
              <tr>
                <td><?php echo $fetch_cart['name']; ?></td>
                <td><?php echo $fetch_cart['type']; ?></td>
                <td> KES <?php echo $fetch_cart['price']; ?> /-</td>

                <td>
                  Ksh <?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['qty']; ?> /-
                </td>
                <td colspan="3">
                  <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="hidden" name="cart_name" value="<?php echo $fetch_cart['name']; ?>">
                    <input type="number"  min="1" name="cart_quantity" value="<?php echo $fetch_cart['qty']; ?>">
                    <button type="submit" style="border: none;" name="update_cart"><i class="fas fa-edit text-success"></i></button>
                  </form>
                  <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('you sure to remove cart?');" class="delete_btn"><i class="fas fa-trash text-danger"></i></a>
                </td>
              </tr>
          <?php

              $grand_total = $grand_total + $sub_total;
            };
          } else {
            echo '<tr><td style="padding:20px;text-transform:capitalize; "colspan="6">
                       no cart added</td></tr>';
          };
          ?>
          <tr class="table_bottom">
            <td colspan="3">Grand total: </td>
            <td> Ksh <?php echo $grand_total; ?> /-</td>
            <td><a href="cart.php?delete_all" class="delete_btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');"><i class="fas fa-trash text-danger"></i></a></td>
          </tr>
        </tbody>
      </table>
      <a href="#" data-toggle="modal" data-target="#add" class="checkout_btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">ORDER NOW</a>


    </div>
  </section>



  <?php
  require_once "footer.inc.php";
  ?>

  <!-- ============LINKS 1========== -->
  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>

  <!-- jQuery -->
  <script src="vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="vendors/nprogress/nprogress.js"></script>
  <!-- iCheck -->
  <script src="vendors/iCheck/icheck.min.js"></script>
  <!-- Datatables -->
  <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="vendors/jszip/dist/jszip.min.js"></script>
  <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="build/js/custom.min.js"></script>



  <!-- ==============================LINKS 2================== -->

  <!-- Vendor JS Files -->
  <script src="theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="theme/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="theme/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="theme/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="theme/assets/js/main.js"></script>
  <script src="theme/assets/css/all.js"></script>

  <script src="js/mainn.js"></script>

</body>

</html>