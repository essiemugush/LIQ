<style>
    .hk-navbar {
        background: #111 !important;
    }
</style>
<nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
    <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><i style="color: white;" class="ion ion-ios-menu"></i></a>
    <a style="color: white;" class="navbar-brand" href="dashboard.php">DRINK-UP LIQOUR</a>
    <ul class="navbar-nav hk-navbar-content">

        <li class="nav-item dropdown dropdown-authentication">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar">
                            <img src="dist/img/user.png" alt="user" class="avatar-img rounded-circle">
                        </div>
                        <span class="badge badge-success badge-indicator"></span>
                    </div>
                    <?php
                    //Getting admin name
                    $email = $_SESSION['email'];
                    $query = "select name from users where email='$email'";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="media-body">
                        <span><?php echo strtoupper($row['name']); ?><i style="color: white;" class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <a class="dropdown-item" href="/DAILY_FARM/FDASHBOARD/dfsms/manage_account.php"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                <a class="dropdown-item" href="manage_account.php"><i class="dropdown-icon zmdi zmdi-settings"></i><span>profile</span></a>
                <div class="dropdown-divider"></div>
                <div class="sub-dropdown-menu show-on-hover">
                    <!-- <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a> -->

                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="return confirm('Are you sure to logout?');" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>sign out</span></a>
            </div>
        </li>
    </ul>
</nav>