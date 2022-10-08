
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="/main/@fortawesome/fontawesome-free/css/all.min.css"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/main/css/style.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>کترینگ آتیسا</title>
    @yield('header')
  </head>
  <body>
    <!--------------------------- START OF HEADER------------------------------>

    <header>
      <div class="container-fluid">
        <div class="row py-2 d-flex align-items-center header-box">
          <div class="col-2 site-logo">
            <img src="/main/images/atysa_logo.png" alt="" />
          </div>
          <div class="col-7 d-flex justify-content-center"></div>
          <div class="col-3 d-flex align-items-center">
            <div class="col-3 avatar mt-1">
              <i class="fas fa-user-circle"></i>
            </div>
            <div class="col-9 text-right">{{Auth::user()->name}}</div>
          </div>
        </div>
      </div>
    </header>

    <!--------------------------- END OF HEADER------------------------------>

    <!--------------------------- START OF MAIN CONTENT------------------------------>
    <div class="container-fluid">
      <div class="row">
        <div class="col-2 side-bar py-5 d-felx justify-content-center">
          <ul class="px-5">
            <li class="py-2">
              <a href="/user/plan" class="py-2">
                <i class="fas fa-home ml-2"></i>

                <span>صفحه اصلی</span>
              </a>
            </li>
            <li class="py-2">
              <a href="/user/plan" class="py-2">
                <i class="fas fa-user-clock ml-2"></i>
                <span>انتخاب غذای هفتگی</span>
              </a>
            </li>
            <li class="py-2">
              <a href="/user/dashboard" class="py-2">
                <i class="far fa-calendar-alt ml-2"></i>
                <span>ساخت غذای اختصاصی</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-10">
          @yield('content')
        </div>
      </div>
    </div>

    <!--------------------------- END OF MAIN CONTENT------------------------------>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>

    @yield('footer')
  </body>
</html>
