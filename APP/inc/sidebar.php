       <style>
           .nav-link,
           .nav-link-text {
               color: white !important;
           }

           .hk-nav-light {
               background: green !important;
           }
       </style>
       <nav class="hk-nav hk-nav-light">
           <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
           <div class="nicescroll-bar">
               <div class="navbar-nav-wrap">
                   <ul class="navbar-nav flex-column">

                       <li class="nav-item">
                           <a class="nav-link" href="dashboard.php">
                               <i class="ion ion-ios-keypad"></i>
                               <span class="nav-link-text">Dashboard</span>
                           </a>
                       </li>


                       <li class="nav-item">
                           <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#product_drp">
                               <i class="ion ion-ios-list-box"></i>
                               <span class="nav-link-text">Records</span></a>
                           <ul id="product_drp" class="nav flex-column collapse collapse-level-1">
                               <li class="nav-item">
                                   <ul class="nav flex-column">
                                       <li class="nav-item">
                                           <a class="nav-link" style="color: #fff;" href="manage-products.php">View Collected milk</a>
                                       </li>
                                       <li class="nav-item">
                                           <a class="nav-link" style="color: #fff;" href="transactions.php">View Transaction status</a>
                                       </li>
                                   </ul>
                               </li>
                           </ul>
                       </li>


                       <li class="nav-item">
                           <a class="nav-link" href="manage_account.php">
                               <i class="ion ion-ios-list-box"></i>
                               <span class="nav-link-text">Manage Account</span>
                           </a>
                       </li>


                       <li class="nav-item">
                           <a class="nav-link" href="view-invoice.php">
                               <i class="ion ion-ios-list-box"></i>
                               <span class="nav-link-text">Generate Invoice</span>
                           </a>
                       </li>

                       <li class="nav-item">
                           <a class="nav-link" href="/DAILY_FARM/APP/indexx.php">
                               <i class="ion ion-ios-list-box"></i>
                               <span class="nav-link-text">Home</span>
                           </a>
                       </li>


                   </ul>






                   <hr class="nav-separator">

               </div>
           </div>
       </nav>