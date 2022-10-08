<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>نظر شما به ما کمک می کند</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- App css -->
		<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <style>
            .rating-faces{
                font-size: 18px;
            }
            label{
                padding-top: 7px;
            }
        </style>
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
                                    <p class="text-muted mb-4 mt-3">نظرتون درباره غذای امروز را با ما به اشتراک بگذارید</p>
                                    {{-- <p class="text-primary mb-4 mt-3">غذای امروز شما : قورمه سبزی</p> --}}
                                    @if($errors->any())
                                        <p  class="text-danger mb-4 mt-3">{{$errors->first()}}</p>
                                    @endif
                                    @if(Session::has('Inserted'))
                                    <div class="alert alert-success" role="alert">
                                        نظر شما با موفقیت ثبت شد.
                                    </div>
                                    @endif
                                </div>
                                @if(!Session::has('Inserted'))
                                <form method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label style="float: right;" for="phone">از ظاهر کلی غذا چقدر  رضایت داشتید ؟</label>
                                        <span id="rateMe1"  class="rating-faces"></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label style="float: right;" for="phone">از رنگ غذا چقدر رضایت داشتید ؟</label>
                                        <span id="rateMe2"  class="rating-faces"></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label style="float: right;" for="phone">از بافت غذا چقدر رضایت داشتید ؟</label>
                                        <span id="rateMe3"  class="rating-faces"></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label style="float: right;" for="phone">از غذای امروز چقدر لذت بردید ؟</label>
                                        <span id="rateMe4"  class="rating-faces"></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label style="float: right;" for="phone">مجددا این غذا را سفارش می دهید ؟</label>
                                        <span id="rateMe5"  class="rating-faces"></span>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <label style="float: right;" for="mobile">شماره موبایل (برای عضویت در باشگاه مشتریان وارد نمایید.)</label>
                                        <input class="form-control" name="mobile" required/>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button style="margin-top: 50px" class="btn btn-secondary btn-block" type="submit"> ثبت نظر </button>
                                    </div>
                                    <input type="hidden" name="zaherKolli"/>
                                    <input type="hidden" name="rangeGhaza"/>
                                    <input type="hidden" name="bafteGhaza"/>
                                    <input type="hidden" name="cheghadrLezzat"/>
                                    <input type="hidden" name="mojaddad"/>
                                </form>
                                @endif
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
        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="/main/mdb/popper.min.js"></script>
        <script type="text/javascript" src="/main/mdb/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="/main/mdb/mdb.min.js"></script>
        <script type="text/javascript" src="/main/mdb/rating.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#rateMe3').mdbRate();
                $('#rateMe1').mdbRate();
                $('#rateMe2').mdbRate();
                $('#rateMe4').mdbRate();
                $('#rateMe5').mdbRate();
                $('.rate-popover').click(function(){
                    $(this).parent().find('.rate-popover').css('color','black');
                    let cond =  $(this).parent().attr('id');
                    let selectedValue = $(this).attr('data-index');
                    let vari = 0;
                    switch(cond){
                        case 'rateMe1':
                            $('input[name="zaherKolli"]').val(selectedValue);
                            break;
                        case 'rateMe2':
                            $('input[name="rangeGhaza"]').val(selectedValue);
                            break;
                        case 'rateMe3':
                            $('input[name="bafteGhaza"]').val(selectedValue);
                            break;
                        case 'rateMe4':
                            $('input[name="cheghadrLezzat"]').val(selectedValue);
                            break;
                        case 'rateMe5':
                            $('input[name="mojaddad"]').val(selectedValue);
                            break;
                    }
                    $(this).css('color','red');
                });
            });
        </script>
    </body>
</html>