<!DOCTYPE html>
<html lang="en" dir="rtl">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="/usersrc/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/usersrc/assets/images/favicon.png" type="image/x-icon">
    <title>کترینگ آتیسا</title>
    <!-- Google font-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/vendors/prism.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/usersrc/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/usersrc/assets/css/responsive.css">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/icons/512.png">
    <meta name="theme-color" content="#fff">
    <link href="/icons/splashscreens/iphone5_splash.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/iphone6_splash.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/iphoneplus_splash.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/iphonex_splash.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/iphonexr_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/iphonexsmax_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/ipad_splash.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/ipadpro1_splash.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/ipadpro3_splash.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/icons/splashscreens/ipadpro2_splash.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Customs css-->
    <link rel="stylesheet" href="/main/css/style.css" />
    @yield('header')
    <style>

      .nav_item:hover 
      {
        background-color: rgb(199 255 212) !important;
     
      }
    </style>

  </head>
  <body class="rtl">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                {{-- <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div> --}}
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="/"><img class="img-fluid" src="/usersrc/assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="nav-right col-12 pull-right right-header p-0">
            {{-- @if($budget != null)   
            @php
             $budget = preg_replace("/\B(?=(\d{3})+(?!\d))/",",",$budget);
            @endphp         
             <div style="display:flex; gap:10px">
              <h5>موجودی </h5>   
              <h5 data-money-text class="text-green">{{$budget}} </h5>
              <h5>تومان</h5>
             </div>  
            @endif --}}
            <ul class="nav-menus">
            
              <li class="profile-nav onhover-dropdown p-0 me-0">
                
                <div class="media profile-media">
                  @if(Auth::user()->avatar)
                  <img class="b-r-10" src="/uploads/avatars/{{auth::user()->avatar}}" width="40px"/>
                  @else
                  <img class="b-r-10" src="/usersrc/assets/images/dashboard/profile.jpg">
                  @endif
                  <div class="media-body"><span>{{Auth::user()->name}}</span>
                    <p class="mb-0 font-roboto">کاربر <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="/user/profile"><i data-feather="user"></i><span>حساب کاربری </span></a></li>
                  <!-- <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                  <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li> -->
                  <li><a href="/logout"><i data-feather="log-in"> </i><span>خروج</span></a></li>
                </ul>
              </li>
              <li>
                <a href="/logout">
                  <i style="font-size: 20px" class="fa fa-power-off"></i>
                </a>
              </li>
            </ul>
            

          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar">
              @if(Auth::user()->avatar)
              <img src="/uploads/avatars/{{auth::user()->avatar}}" />
              @else
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
              @endif
            </div>
            <div class="ProfileCard-details">
         
            </div>
            </div>
          </script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="/"><img class="img-fluid for-light" src="/main/images/atysa_logo.png" width="80px" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <!-- <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div> -->
            </div>
            <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar" style="gap:20px">
                  <li class="back-btn"><a href="index.html"><img class="img-fluid" src="/main/images/atysa_logo.png" alt=""></a>
                    <div class="mobile-back text-end"><span>بازگشت</span><i class="fa fa-angle-left ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-1">سقف کالری روزانه شما</h6>
                      <p class="lan-2"><span id="maxDailyCalory">
                        {{Auth::user()->calory ? Auth::user()->calory : 'ثبت نشده'}}  
                      </span></p>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/"><i class="myicon myfoods"></i><span class="lan-3">مشاهده ی غذای من</span></a>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/user/plan"><i class="myicon calendar"></i><span class="lan-3">انتخاب غذای ماه</span></a>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/user/all-plates"><i class="myicon myplates"></i><span class="lan-3">بشقاب های من</span></a>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/user/create-plate"><i class="myicon createplate"></i><span class="lan-3">ساخت بشقاب</span></a>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/user/calory"><i class="myicon calory"></i><span class="lan-3">میزان کالری من</span></a>
                  </li>
                  @php
                  $companyId = Auth::user()->companyId;
                  $company = App\Models\Company::find($companyId);
                  $plateFee = $company->plateFee ? $company->plateFee : 0;

                    $hasWallet = $plateFee <= 0 ? false : true;
                  @endphp
                  @if($hasWallet)
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title nav_item" href="/user/wallet" >
                      <i class="myicon wallet"></i>
                      <span class="lan-3">کیف پول</span>
                    </a>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title nav_item" href="/user/transactions" >
                      <i class="myicon transaction"></i>
                      <span class="lan-3">تراکنش ها</span>
                    </a>
                  </li>
                  @endif
            
                  @if(Auth::user()->type == 4)
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/company" >
                      <i style="margin-left: 15px;font-size: 20px; " class="fa fa-user"></i>
                      <span class="lan-3">بازگشت به پنل مدیریت</span>
                    </a>
                  </li>
                  @endif
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
        <!-- Page Sidebar Ends-->
        
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">

                  @yield('content')
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">کلیه حقوق این پایگاه متعلق به آتیسا می باشد.  </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="/usersrc/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/usersrc/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/usersrc/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/usersrc/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="/usersrc/assets/js/scrollbar/simplebar.js"></script>
    <script src="/usersrc/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="/usersrc/assets/js/config.js"></script>
    <!-- Plugins JS start-->

    <script src="/usersrc/assets/js/sidebar-menu.js"></script>
    <script src="/usersrc/assets/js/prism/prism.min.js"></script>
    <script src="/usersrc/assets/js/clipboard/clipboard.min.js"></script>
    <script src="/usersrc/assets/js/custom-card/custom-card.js"></script>
    <script src="/usersrc/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    
    <!-- login js-->
    <!-- Plugin used-->
    @yield('footer')
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
  <script>
    if ('serviceWorker' in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
        console.log('Service worker registration succeeded:', registration);
      }, /*catch*/ function(error) {
        console.log('Service worker registration failed:', error);
      });
    } else {
      console.log('Service workers are not supported.');
    }
  </script>
  {{-- <script src="/usersrc/assets/js/script.js"></script>
  <script src="/usersrc/assets/js/theme-customizer/customizer.js"></script> --}}
  </body>
</html>