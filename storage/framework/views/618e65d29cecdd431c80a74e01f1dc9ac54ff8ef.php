<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="preload" href="/main/fonts/iransans/IRANSansWeb(FaNum)_Medium.ttf" as="font"
    crossorigin="anonymous" />
    <title>Document</title>
</head>
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
    }  
    .left
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 50%;
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
</style>


<body>
    <div class="column">
        <div class="left">
            <img src="/main/images/logo.png"/>
            <div id="animation">
                <?php if($ok): ?>
                <script src="/main/js/lottie-player.js"></script>
                <lottie-player src="/main/animations/successful.json"  background="transparent"  speed="0.45"  style="width: 300px; height: 300px;" autoplay></lottie-player>
                <?php endif; ?>
            </div>
            <h1>
                پرداخت با موفقیت انجام شد
            </h1>
        </div>
        <div class="table">
            <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <span class="item"><?php echo e($plate->name); ?></span>
                <span class="item"><?php echo e($plate->date); ?></span>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
   
</body>
</html><?php /**PATH F:\Projects\atysa-app\resources\views/purchase.blade.php ENDPATH**/ ?>