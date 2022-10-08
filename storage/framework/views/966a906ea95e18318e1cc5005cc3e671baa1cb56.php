
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
                                <a href="/company/profile" class="dropdown-item notify-item">
                                    <span>پروفایل</span>
                                </a>
                                <a href="/logout" class="dropdown-item notify-item">
                                    <i class="fe-log-out mr-1"></i>
                                    <span>خروج</span>
                                </a>
    
                            </div>
                        </div>
                        <p class="text-muted">
                            مدیر شرکت
                        </p>
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

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-view-list"></i>
                                    <span> کارمندان </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="/company/users/all">همه ی کارمندان</a></li>
                                    <li><a href="/company/users/new">افزودن کارمند تازه</a></li>
                                    <li><a href="/company/users/file">افزودن همه کارمندان با یک فایل</a></li>
                                </ul>
                            </li>
                            <li><a href="/company/side/all">انتخاب پیش غذاها</a></li>
                            <li><a href="/company/meals/all">انتخاب غذای مهمان</a></li>
                            <li><a href="/company/day"> غذاهای امروز</a></li>
                            <li><a href="/company/month"> غذاهای این ماه</a></li>
                            <li><a href="/company/hotbox"> مشاهده هات باکس</a></li>
                            <?php if(Auth::user()->company->accessCamera): ?>
                            <li><a href="/company/cam"> مشاهده دوربین های آشپزخانه</a></li>
                            <?php endif; ?>
                            <li><a href="/"> ورود به پنل کاربری شما</a></li>
                            <li><a href="/company/polls"> مشاهده نظرات</a></li>
                            
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
                               کلیه حقوق این پایگاه متعلق به آتیسا می باشد.
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
</html><?php /**PATH F:\Projects\atysa-app\resources\views/layouts/company.blade.php ENDPATH**/ ?>