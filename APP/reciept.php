<?php
error_reporting(0);
include('inc/connection.inc.php');
$db = db_conn();
if (!isset($_SESSION['email'])) {
    echo "<script>
    alert('Login first to access this page');
    location.assign('Login/login.php');
    </script>";
} else {
    $email = $_SESSION['email'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Reciept</title>
        <!-- Data Table CSS -->
        <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
        <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
        <link href="dist/css/style.css" rel="stylesheet" type="text/css">

        <style type="text/css" media="print">
            @media print {

                .noprint,
                .noprint * {
                    display: none !important;
                }
                #pr{
                    display: none;
                }
            }

        </style>

    </head>

    <body>

        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">

            <!-- Container -->
            <div class="container">

                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="file"></i></span></span>DELIVERY IN PROGRESS</h4>
                    <button id="pr" class="btn btn-block btn-primary" onclick="print();" type="button" name="submit">Print Reciept</button>
                </div>

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">


                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-7 mb-20">
                                        <h6 class="mb-5 text-success">DRINK-UP LIQOUR STORE</h6>
                                    </div>
                                    <?php
                                    //Consumer Details
                                    $sql = "SELECT  * FROM customer_payments where email = :email";
                                    $fetchdatastmt = $db->prepare($sql);
                                    $fetchdatastmt->bindValue(':email', $email);
                                    $fetchdatastmt->execute();
                                    while ($row = $fetchdatastmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <div class="col-md-5 mb-20">
                                            <h4 class="mb-35 font-weight-600">Receipt</h4>
                                            <span class="d-block">Date:<span style="color: slateblue" class="pl-10"><?php echo $row['date']; ?></span></span>
                                            <span class="d-block">Receipt #<span style="color: slateblue" class="pl-10"><?php echo $row['MpesaRefNo']; ?></span></span>
                                            <span class="d-block">Paybill #<span style="color: slateblue" class="pl-10"><?php echo $row['shortcode']; ?></span></span>
                                            <span class="d-block">Email #<span style="color: slateblue" class="pl-10"><?php echo $row['email']; ?></span></span>
                                            <span class="d-block">Mobile No #<span style="color: slateblue" class="pl-10"><?php echo $row['phone']; ?></span></span>
                                            <span class="d-block">Amount Paid #<span style="color: green" class="pl-10"><?php echo number_format($row['amount'], 2); ?></span></span>
                                        </div>
                                </div>
                            </div>
                        <?php } ?>
                        <hr class="mt-0">

                        <div class="row">
                            <div class="col-sm">
                                <div class="table-wrap">
                                    <table class="table mb-0" border="1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Product Type</th>
                                                <th>Quantity</th>
                                                <th>price </th>
                                                <th>Total</th>
                                                <th>Date </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //Product Details
                                            $cnt = 1;
                                            $grandtotal = 0;
                                            // $sql = "SELECT sum(payments.amount) as amt, sum(products.qty * products.price) as tamt  FROM ((users INNER JOIN payments ON users.member_no = payments.member_no) INNER JOIN products ON users.member_no = products.member_no) where email = :email";
                                            $sql = "SELECT  * FROM cart where email = :email";
                                            $fetchdatastmt = $db->prepare($sql);
                                            $fetchdatastmt->bindValue(':email', $_SESSION['email']);
                                            $fetchdatastmt->execute();
                                            while ($row = $fetchdatastmt->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td><?php echo $row['price']; ?></td>
                                                    <td><?php echo number_format($sub_total = $row['qty'] * $row['price'], 2) ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                </tr>

                                            <?php
                                                $grandtotal += $sub_total;
                                                $cnt++;
                                            } ?>
                                            <tr>
                                                <th colspan="5" style="text-align:center; font-size:20px;">Total</th>
                                                <th class="text-success" style="text-align:left; font-size:20px;"><?php echo number_format($grandtotal, 2); ?></th>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </section>

                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

            <!-- Footer -->
            <?php //include_once('includes/footer.php');
            ?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="dist/js/jquery.slimscroll.js"></script>
        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>
        <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="dist/js/dataTables-data.js"></script>
        <script src="dist/js/feather.min.js"></script>
        <script src="dist/js/dropdown-bootstrap-extended.js"></script>
        <script src="vendors/jquery-toggles/toggles.min.js"></script>
        <script src="dist/js/toggle-data.js"></script>
        <script src="dist/js/init.js"></script>
    </body>

    </html>
<?php } ?>