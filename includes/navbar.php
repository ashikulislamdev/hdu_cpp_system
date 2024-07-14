<nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                   <div class="navbar-logo">
                       <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class='bx bx-menu bx_large'></i>
                       </a>
                       <div class="mobile-search">
                           <div class="header-search">
                               <div class="main-search morphsearch-search">
                                   <div class="input-group">
                                       <span class="input-group-addon search-close"><i class='bx bx-x bx_large'></i></span>
                                       <input type="text" class="form-control search-input-box" placeholder="Enter Keyword">
                                       <span class="input-group-addon search-btn"><i class='bx bx-search-alt-2 bx_large'></i></span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <a href="dashboard.php">
                           <!-- <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" /> -->
                           <h5><i>CPP</i> S<span class="text-lowercase">ystem</span></h5>
                       </a>
                       <a class="mobile-options">
                            <i class='bx bx-menu bx_large' style='font-size:22px'></i>
                       </a>
                   </div>

                   <div class="navbar-container container-fluid">
                       <ul class="nav-left">
                           <li>
                               <div class="sidebar_toggle"><a href="javascript:void(0)"><i class='bx bx-menu bx_large'></i></a></div>
                           </li>
                           <li class="header-search">
                               <div class="main-search morphsearch-search">
                                   <div class="input-group">
                                       <span class="input-group-addon search-close"><i class='bx bx-x bx_large'></i></span>
                                       <input type="text" class="form-control search-input-box">
                                       <span class="input-group-addon search-btn"><i class='bx bx-search-alt-2 bx_large'></i></span>
                                   </div>
                               </div>
                           </li>
                           <li>
                               <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class='bx bx-fullscreen bx_large' style='font-size:22px'></i>
                               </a>
                           </li>
                       </ul>
                       <ul class="nav-right">
                           
                           <li class="user-profile header-notification">
                               <a href="#!">
                                   <img src="<?php echo "images/". $current_user['image'] ?? null; ?>" onerror="this.src='assets/images/logo.png'" class="img-radius" alt="User-Profile-Image" style="background: rgba(255,255,255,0.7);">
                                   <span><?php echo $current_user['name'] ?? null; ?></span>
                                   <i class='bx bx-chevron-down' style='font-size:22px'></i>
                               </a>
                               <ul class="show-notification profile-notification">
                                   <li>
                                       <a href="profile.php" class="d-flex align-items-center">
                                            <i class='bx bx-user'  style="font-size:23px"></i> &nbsp; Profile
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#"  class="d-flex align-items-center">
                                            <i class='bx bx-lock'  style="font-size:23px"></i> Lock Screen
                                       </a>
                                   </li>
                                   <li>
                                       <a href="logout.php" class="d-flex align-items-center">
                                            <i class='bx bx-log-out-circle'  style="font-size:23px" ></i> Logout
                                       </a>
                                   </li>
                               </ul>
                           </li>
                       </ul>
                   </div>
               </div>
           </nav>