
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <b><h2>DRINK-UP LIQOUR</h2></b>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <?php 
                    $sqls = "SELECT * FROM admin where email_id = '$email'";
                    $fetchdata = $db->prepare($sqls);
                    $fetchdata->execute();
                    $rows=$fetchdata->fetch(PDO::FETCH_ASSOC)
                    ?>
                    <h3><span class="text-info"><?php echo $rows['username'] ?></span></h3>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">

                      
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="images/av1.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="view_admin.php"><i class="ti-user"></i> Profile</a></li>
                                     <li><a href="changepassword.php"><i class="ti-key"></i> Changed Password</a></li>
                                    <li><a onclick="return confirm('you sure to logout?');" href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->