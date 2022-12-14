
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Atysa - <?php echo $__env->yieldContent('title'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="main/images/atysa_logo.png">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app-rtl.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        <link href="/assets/css/custom.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        <?php echo $__env->yieldContent('style'); ?>
    </head>
<style>
    .card 
    {
        border-radius: 20px !important;
    }
table, table td , table th 
{
    border:none !important;
    
}

tr:nth-child(even) {
    background-color: #f2f2f2;
    }

    .btn 
    {
        border-radius: 20px !important;
        margin: 2px;
    }
    input
    {
        border-radius: 20px !important;
    }
</style>
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-lg">
                            <img src="/assets/images/atysa_logo.png" alt="" height="32">
                        </span>
                        <span class="logo-sm">
                            <img src="/assets/images/logo-sm.png" alt="" height="24">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-lg">
                            <img src="/assets/images/logo-light.png" alt="" height="16">
                        </span>
                        <span class="logo-sm">
                            <img src="/assets/images/logo-sm.png" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                    <li>
                        <button class="button-menu-mobile disable-btn waves-effect">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        
                    </li>
        
                </ul>

            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!-- User box -->
                    <div class="user-box text-center">
                        <?php if(Auth::user()->avatar): ?>
                        <img class="b-r-10" src="/uploads/avatars/<?php echo e(auth::user()->avatar); ?>" width="40px"/>
                        <?php else: ?>
                        <img src="/assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                        <?php endif; ?>
                        <div class="dropdown">
                            <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown"  aria-expanded="false"><?php echo e(Auth::user()->name); ?></a>
                            <div class="dropdown-menu user-pro-dropdown">

    
                                <!-- item-->
                                <a href="/admin/profile" class="dropdown-item notify-item">
                                    <span>??????????????</span>
                                </a>
                                <a href="/logout" class="dropdown-item notify-item">
                                    <i class="fe-log-out mr-1"></i>
                                    <span>????????</span>
                                </a>
    
                            </div>
                        </div>
                        <p class="text-muted">??????????</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">
                                    <i class="mdi mdi-cog"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="/logout">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">??????????????</li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ?????????????? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/users/all">??????</a></li>
                                    <li><a href="/admin/users/new">????????????</a></li>
                                    <li><a href="/admin/userplate/all">?????????? ???????? ??????????????</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ???????? ???? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/companies/all">??????</a></li>
                                    <li><a href="/admin/companies/new">????????????</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">??????????</li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ???????? ?????????? ?????????? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/materials/all">??????</a></li>
                                    <li><a href="/admin/materials/new">????????????</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ???????????? ???????? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/plates/all">??????</a></li>
                                    <li><a href="/admin/plates/new">????????????</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ???????? ???? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/side/all">??????</a></li>
                                    <li><a href="/admin/side/new">????????????</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ?????? ???????? ???? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/hotbox/all">??????</a></li>
                                    <li><a href="/admin/hotbox/new">????????????</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ?????? ?? ?????? ?????? ?? ?????????????? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/dessert/all">??????</a></li>
                                    <li><a href="/admin/dessert/new">????????????</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ???????????? ?????????? ?????????????? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="mdi mdi-view-list"></i>
                                            <span>?????? ????</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level" aria-expanded="false">
                                            <li><a href="/admin/plans/all">??????</a></li>
                                            <li><a href="/admin/plans/new">????????????</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> ?????????????? ???????? </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/admin/holiday/all">??????</a></li>
                                    <li><a href="/admin/holiday/new">????????????</a></li>
                                </ul>
                                <li><a href="/admin/logistic">??????????????</a></li>
                                <li><a href="/admin/poll">?????????? ??????????????</a></li>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <?php echo $__env->yieldContent('content'); ?>

                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                               ???????? ???????? ?????? ???????????? ?????????? ???? ?????????? ???? ????????.
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        

        <!-- Vendor js -->
        <script src="/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="/assets/js/app.min.js"></script>
        <?php echo $__env->yieldContent('script'); ?>
        <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '7cbaca03ea7021dfa119f10f9e01c3e24ac7d566';
        window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
    </script>
    </body>
</html><?php /**PATH F:\Projects\atysa-app\resources\views/layouts/admin.blade.php ENDPATH**/ ?>