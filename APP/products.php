<?php
session_start();
error_reporting(0);
//connect to database
include('inc/connect.php');

if (!isset($_SESSION['email'])) {
    echo "<script>
    location.assign('Login/login.php');
    </script>";
} else {
    $email = $_SESSION['email'];
}




if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['pname'];
    $product_type = $_POST['type'];
    $product_price = $_POST['price'];
    $product_image = $_POST['pimage'];
    $product_quantity = $_POST['product_quantity'];

    $select_query = "SELECT * FROM cart   where name = '$product_name' AND email = '$email'";
    $result = mysqli_query($db, $select_query);
    $user_cart = mysqli_fetch_assoc($result);
    if ($user_cart) {
        //matched product error definition
        if ($user_cart['name'] === $product_name) {
            echo "<script>
            alert('Cart already added!');
            </script>";
        }
    } else {
        $insert_query = "INSERT INTO cart (name,type,price,image,qty,email) 
        VALUES ('$product_name','$product_type', '$product_price','$product_image','$product_quantity','$email')";
        $query_run = mysqli_query($db, $insert_query);
        $_SESSION['name'] = $usname;
        if ($query_run) {

            echo "<script>
            alert('cart added successfuly!');
            location.assign('cart.php#shop_cart');
            </script>";
        } else {
            echo "<script>
            alert('Could not insert into the database');
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTS</title>
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

    <link rel="stylesheet" href="style.css" media="all">

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

    <div class="container">
        <h2 class="mt-4">Our Products</h2>
        <div class="row">
            <?php
            $select_query = " SELECT * FROM product";
            $select_product = mysqli_query($db, $select_query);
            if (mysqli_num_rows($select_product) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_product)) { ?>
                    <div class="col-md-3" class="products-tabs">
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <!-- product -->
                                <div class="product">
                                    <div class="product-img">
                                        <img src="/LIQ/ADASH/service_images/<?php echo $fetch_product['image']; ?>" alt="">
                                        <div class="product-label">
                                            <span class="sale">-30%</span>
                                            <span class="new">NEW</span>
                                        </div>
                                    </div>
                                    <div class="product-body">

                                        <form action="" method="post">
                                            <p class="product-category"><?php echo $fetch_product['type']; ?></p>
                                            <h3 class="product-name"><a href="#"><?php echo $fetch_product['name']; ?></a></h3>
                                            <h4 class="product-price"><?php echo $fetch_product['price']; ?> <del class="product-old-price"><?php echo $fetch_product['price'] - 110; ?></del></h4>
                                            <input type="hidden" min="1" name="product_quantity" value="1">
                                            <input type="hidden" name="pimage" value="<?php echo $fetch_product['image']; ?>">
                                            <input type="hidden" name="pname" value="<?php echo $fetch_product['name']; ?>">
                                            <input type="hidden" name="type" value="<?php echo $fetch_product['type']; ?>">
                                            <input type="hidden" name="qty" value="<?php echo $fetch_product['qty']; ?>">
                                            <input type="hidden" name="price" value="<?php echo $fetch_product['price']; ?>">
                                            <button type="submit" name="add_to_cart" class="btn btn-block btn-primary"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                        </form>

                                    </div>
                                </div>
                                <!-- /product -->

                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
            <?php
                }
            } else {
                echo '<tr><td style="padding:20px;text-transform:capitalize; "colspan="6">
                                            no Products Available</td></tr>';
            };
            ?>

        </div>
    </div>




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