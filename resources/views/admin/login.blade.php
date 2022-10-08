<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>ورود به حساب کاربری</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- App css -->
		<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg authentication-bg-pattern" style="direction: rtl">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="/main/images/atysa_logo.png" alt="" height="50">
                                            </span>
                                        </a>
                    
                                        <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="/main/images/atysa_logo.png" alt="" height="50">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">ورودی ادمین</p>
                                    @if($errors->any())
                                        <p  class="text-danger mb-4 mt-3">{{$errors->first()}}</p>
                                    @endif
                                    @if(isset($error))
                                        <p  class="text-danger mb-4 mt-3">{{$error}}</p>
                                    @endif
                                </div>

                                <form method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label style="float: right;" for="mobile">شماره تلفن همراه</label>
                                        <input  maxlength="11" class="form-control" type="text" id="mobile" name="mobile" required="" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label style="float: right;" for="phone">رمز عبور</label>
                                        <input class="form-control" type="password" id="password" name="password" required="" placeholder="">
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> ورود </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="/assets/js/app.min.js"></script>
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
</html>