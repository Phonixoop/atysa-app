<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preload" href="/main/fonts/iransans/IRANSansWeb(FaNum)_Medium.ttf" as="font"
    crossorigin="anonymous" />
    <title>Document</title>
    <script src="/main/js/lottie-player.js" async></script>
    <style>
        @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-weight: 500;
        src: url("https://blufy.ir/wp-content/themes/woodmart/Landing/fonts/IRANSansWeb_Medium.ttf") format("truetype");
        font-display: swap;
    }

    @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-weight: 300;
        src: url("https://blufy.ir/wp-content/themes/woodmart/Landing/fonts/IRANSansWeb_Light.ttf") format("truetype");
        font-display: swap;
    }
    * 
    {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    html 
    {
        width: 100vw;
        height: 100vh;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "iransans" !important;
        width: 100%;
        height: 100%;
        font-weight: 300;
        background-color: #F3F3F4;
    }

    img {
        width: 100px;
        height: auto;
    }
    h1 
    {
        font-size: 30px;
    }
    .column
    {
        display: flex;
        flex-direction: row;
        width: 100%;
        gap: 10px;
    }  
    .row 
    {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        width: 100%;
        gap:10px;
    }
    .left
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 50%;  
        gap:20px;
    }
    .table
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap:5px;
        width: 50%;   
        padding: 10px;
    }
    .item 
    {
        background-color:  #ffffff;
        border-radius: 100000px;
        text-align: center;
        width: fit-content;
        padding: 5px 10px;
    }
    .button
    {
        width: fit-content;
        padding: 1rem 2rem;
        background: white;
        border-radius: 100000px;
        text-decoration: none !important;
    }
    .button:hover
    {
        background-color: transparent;
        color: black;
    }
</style>
</head>



<body>
    @isset($ok)
    @if($ok)
   <div class="row">
    <div class="column">
        <div class="left">
            <img src="/main/images/logo.png"/>
            <div id="animation">
             
              
                <lottie-player src="/main/animations/successful.json"  background="transparent"  speed="0.45"  style="width: 300px; height: 300px;" autoplay></lottie-player>
            
            </div>
            <h1 style="color: #34e449">
                پرداخت با موفقیت انجام شد
            </h1>
            <a class="button" href="/">بازگشت به سایت</a>
        </div>
        <div class="table">
            @foreach($plates as $plate)
              <div class="item">
                <span class="item">{{$plate->name}}</span>
                <span class="item">{{$plate->date}}</span>
              </div>
            @endforeach
        </div>
    </div>
   </div>
    @else
    <div class="row">

    <div class="left">
        <img src="/main/images/logo.png"/>
        <div id="animation">   
          
            <lottie-player src="/main/animations/failed.json"  background="transparent"  speed="0.45"  style="width: 300px; height: 300px;" autoplay></lottie-player>     
        </div>
        <h1 style="color: #e43434">
          پرداخت شما با موفقط انجام نشد
        </h1>
        <a class="button" href="/">بازگشت به سایت</a>
    </div>
    @endif
    @endisset
    </div>
   
</body>
</html>