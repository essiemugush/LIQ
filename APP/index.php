<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRINK-UP</title>
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
          .whatsup{
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
            0%{
                transform: scale(1.3);
            }
            50%{
                transform: scale(1);
            }
            100%{
                transform: scale(1.3);
            }
          }

          #hero .carousel-indicators li.active {
            opacity: 1;
            background: orangered!important;
          }
        </style>
</head>
<body>
    <?php
		// require 'menu.php';
		require_once "header.inc.php";
	?>

        <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>About</h2>
        </div>

        <div class="row">
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
            <p>
              Drink up liqour store is an online based like e-commerce shop developed by DRINK-UP IT staff to streamlie the daily procedures of this shop and also helping customers from all over the nation to order their best liqours online and get them delivered in the quickest way possible through our dedicated trasport and delivery system.

              Drink up liqour store is an online based like e-commerce shop developed by DRINK-UP IT staff to streamlie the daily procedures of this shop and also helping customers from all over the nation to order their best liqours online and get them delivered in the quickest way possible through our dedicated trasport and delivery system.
            </p>
          </div>
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
            <img src="images/w17.jpg" class="img-fluid" alt="" width = "500" hight="300">
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

<!-- ====================MODALS SECTION================ -->
<!--MODAL START-->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADMIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form action="" method="POST" id="payment">
        <div class="modal-body">

            <div class="form-group">
                <label for="exampleInputEmail1">Enter Your Email</label>
                <input type="email" name="email" class="form-control" id="email"  placeholder="isaackamau@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Enter Your password</label>
                <input type="password" name="password" class="form-control" id="password"  placeholder="Enter Password" required>
                <i class="fas fa-eye-slash showhide" id="hide" onclick="myshowhidefunc()"></i>
                <i class="fas fa-eye showhide" id="show" onclick="myshowhidefunc()"></i>
            </div>
            
            <div class="form-group ml-4">
                <input style="box-shadow: none;" class="form-check-input remember-me" name="remember_me" checked type="checkbox">
                <label class="form-check-label" for="remember_me"><?php if(isset($_COOKIE['email'])) { ?>  <?php } ?> remember me</label>
            </div>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="login" class="btn btn-success">Login</button>
      </div>
        <div class="col-md-6 mb-3 mt-3 text-field text-left">
            <div class="sign-up">Not our member ? <a href="/index.php#register">Register</a></div>
        </div>
    </form>

    </div>
  </div>
</div><!--MODAL ENDS HERE-->


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