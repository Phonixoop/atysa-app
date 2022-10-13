 
<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script src="/main/js/num2persian-min.js" async></script>
<style>
/* Chrome, Safari, Edge, Opera */
.input::-webkit-outer-spin-button,
.input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
.input[type=number] {
  -moz-appearance: textfield;
  
}
  
  :root 
  {
    --text-green : rgb(25, 158, 163);
  }
  .btns_holder 
  {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    column-gap: 10px;
  }
  .btn_choose
  {
    background-color: #ffffff;
    border:1px solid gray;
    border-radius: 100000px;
    font-size: 18px;
    font-weight: 100;
    padding: 0.3em 0.8em;
    cursor: pointer;
    user-select: none;
 
  }
  .btn_choose.offered_value
  {
    border:2px solid #002f00;
  }
  .btn_addsub
  {
    display: grid;
    place-content: center;
    text-align: center;
    background-color: #ffffff;
    border:2px solid gray;
    color: gray;
    border-radius: 7px;
    font-size: 18px;
    font-weight: 100;
    padding: 5px 8px !important;
    user-select: none;
    cursor: not-allowed;
  }
  .btn_addsub.enabled 
  {
    border:2px solid var( --text-green);
    color:var( --text-green);
    cursor: pointer;
  }
  .btn_active
  {  
    border:2px solid #199EA3;
    box-shadow: 1px 1px 10px #199ea37f
  }
  .submit
  {
    outline: none;
    border:none;
    width: 250px;
    padding: 10px 0px;
    border-radius: 10px;
    margin-top: 10px;
    background-color: #6e7677;
    color: white;
    user-select: none;
    cursor: not-allowed;
    transition: 300ms ease-in-out background-color;
  }
  .submit.submit_active
  {
    background-color: #199EA3;
    cursor: pointer;
  }
  .visible 
  {
    visibility: visible;
  }
  .row 
  {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
  }
  .img 
  {
    transform: rotateZ(6deg);
    user-select: none;
  }
  .column 
  {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap:5px;
  }
  .box 
  {
    background-color: white;
    border-radius: 30px;
    padding: 20px 0 !important;
    width: 500px;
    row-gap:10px;
    box-shadow: 0px 0px 50px rgba(25, 158, 163, 0.05);
  }
  @media only screen and (max-width:900px) {
      .box 
      {
        width: 100%;

      }
      .btn_choose 
      {
        font-size:14px;
      }
      .input_holder 
      {
        column-gap: 0 !important;
      }
      .submit 
      {
        width: 90%;
      }
    }

  .current_budget 
  {
    display: flex;
    width: 100%;
    flex-direction: row;
    justify-content: space-around;
  }
  .seperator
  {
    width: 100%;
    height: 5px;
    background-color: #F8F8F8;
  }
  .choose_price
  {
    display: flex;
    flex-direction: column;
    gap: 13px;
    padding: 10px 0px;
  }
  .input 
  {
    outline: none;
    border:none;
    text-align: center;
    font-size: 20px;
    color:transparent;
    opacity: 1;
    caret-color: #199ea300;
  }
  .input_holder 
  {
    display: flex;
    flex-direction: row;
    column-gap:10px;
  }
  .caret 
  {
    color:#199EA3;
    display: inline-block;
    overflow: visible;
    animation: blink 0.8s infinite;
    animation-timing-function: cubic-bezier(1, -1, 0, 1);
  }
  
@keyframes blink {
	0% {opacity: 0}
	49%{opacity: 0}
	50% {opacity: 1}
}

  .result 
  {
    font-size:14px;
    visibility: hidden;
  }
  .text-green
  {
    color:  var(--text-green);
  }
</style>
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
          <div class="col-6">
              <h3>کیف پول</h3>
          </div>
          <div class="col-6">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="/">
                          <i data-feather="home"></i
                      ></a>
                  </li>
                  <li class="breadcrumb-item">کیف پول</li>
              </ol>
          </div>
      </div>
  </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row" style="transform: translateY(-103px);">
      <div class="col-sm-12" style="padding:0px !important">
          <div class="row" style="gap:5px;">
            <div class="column">    
              <img class="img" src="/main/images/wallet.png" width="300px" height="300px" />
            </div>
          
            <form class="column box" method="POST" action="/user/wallet/charge">
              <?php echo csrf_field(); ?>
              <div class="current_budget">
                <h4>موجودی فعلی</h4>
                <?php $budget = preg_replace("/\B(?=(\d{3})+(?!\d))/",",",$budget); ?> 
                <h4  class="text-green"><?php echo e($budget); ?> تومان</h4> 
              </div>
              <div class="seperator"></div>
              <div class="choose_price">

                  

                  <div class="btns_holder">
                    <span data-btn-money class="btn_choose" onclick="btnClick(event,'10000')">10,000 تومان</span>
                    <span data-btn-money class="btn_choose" onclick="btnClick(event,'20000')">20,000 تومان</span>
                    <span data-btn-money class="btn_choose" onclick="btnClick(event,'50000')">50,000 تومان</span>
                  </div>
   
              </div>
              <div class="input_holder">
                
                <span data-btn-add class="btn_addsub enabled" onclick="changePrice('10000')" >
                  <svg width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13 11h4a1 1 0 010 2h-4v4a1 1 0 01-2 0v-4H7a1 1 0 010-2h4V7a1 1 0 012 0v4z">
                      </path>
                    </svg>
                  </span>

                <div data-focus style="display: flex; justify-content: center ; align-items: center">
                  <input data-input type="number" autocomplete="off" class="input" placeholder="مبلغ دلخواه" value="" type="text" name="amount" id="amount" required>
                  <div style="position: absolute; white-space: pre; display: flex; align-items: center; gap:5px;">
                    <span style="position: relative;font-size: 20px; display:flex">
                      <span data-caret class="caret">|</span>
                      <span data-input-value></span>
                    </span>
                    <span data-input-static style="position: relative;font-size: 10px"></span>
                  </div>
                </div>
                <span data-btn-sub class="btn_addsub" onclick="changePrice('-10000')">
                  <svg  width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7 13a1 1 0 010-2h10a1 1 0 010 2H7z">
                      </path>
                  </svg>  
                </span>
              
              </div>
              <button data-btn-submit disabled class="submit">شارژ کیف پول</button>
              <p data-price-in-word class="result hidden">0</p>
              <p class="">به مبلغ پرداختی 9 درصد مالیات بر ارزش افزوده اضافه می گردد</p>
            </form>
          </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>


  
<script async> 

const input = document.querySelector('[data-input]');
const divForFocus = document.querySelector('[data-focus]');
const inputSpan = document.querySelector('[data-input-value]');
const spanStatic = document.querySelector('[data-input-static]');
const btnSubmit = document.querySelector('[data-btn-submit]');
const result = document.querySelector('[data-price-in-word ]');
const btns_money = document.querySelectorAll('[data-btn-money]');
const caret = document.querySelector('[data-caret]');
const addBtn = document.querySelector('[data-btn-add]');
const subBtn = document.querySelector('[data-btn-sub]');
input.focus();
divForFocus.addEventListener('click', function()
{
  input.focus();
})
input.addEventListener('blur', (e) => caret.style.visibility = 'hidden');
input.addEventListener('focus', (e) => caret.style.visibility = 'visible');
 // input.addEventListener('change', onChange(e.target.value));
  input.addEventListener('input', (e) => onChange(e.target.value));

  const MAX_PRICE = 1000000;
  const MIN_PRICE = 10000;

function parse(val) {
   const value =  val.toString().replace(/[^0-9]/g, "") || "";
   return parseInt(value.toString().substr(0,  MAX_PRICE.toString().length )) || "";
}

function changePrice(val)
{
  const value  =  parseInt(val);

  const prev  = parse(input.value) || 0;
  const finalValue = prev + value;
  if(finalValue < MIN_PRICE )
 {
  console.log("here")
  disable({btnSubmit,subBtn});
  return setInput(0);
 }
  if(finalValue > MAX_PRICE)
    return
  onChange(finalValue);
}

function btnClick(e,val) {

  let lastValue = 0;
   if(input.value) 
     lastValue = parseInt(input.value);
    const value  = lastValue + parseInt(parse(val));

    onChange(val);
    btns_money.forEach(el => el.classList.remove('btn_active'));
    e.target.classList.add("btn_active");
 }


 function onChange(val)
 {
 // input.selectionStart = input.selectionEnd = 10000;

  
  if(!val || val == 0)
  {
    disable({btnSubmit,subBtn});

    setInput(0);
    return;
  }


   
   const value = val;
   // const value  = isNaN(val) ? parse(val) || undefined : val;
   if(value > MAX_PRICE)
     {
      return setInput(lastValue);
     }
    if(value < MIN_PRICE)
    { 
      disable({btnSubmit,subBtn});
      setInput(value);
      return
    }
  
    enable({btnSubmit,subBtn}); 

    setInput(value);
  
 }
 function disable({btnSubmit,subBtn})
 {
  btnSubmit.disabled = true;
  btnSubmit.classList.remove("submit_active");

  subBtn.disabled = true;
  subBtn.classList.remove("enabled");

  result.classList.remove("visible")
 }
 function enable({btnSubmit,subBtn})
 {
  

   btnSubmit.disabled = false;
   btnSubmit.classList.add("submit_active");

   subBtn.disabled = false;
   subBtn.classList.add("enabled");

   result.classList.add("visible")
 }
 function setInput(value)
 {
  inputSpan.textContent =  commify(value) || "";
  if(value === 0)
  input.value = "";
   if(value){
      
     input.value = value;
    lastValue = value;

    result.textContent = Num2persian(value) + " تومان";
    spanStatic.textContent = "تومان";
   }
   else
   {
     result.classList.remove("visible");
     result.textContent = "0";
     spanStatic.textContent = "";
   }
  
 
 }

 function commify(x) {

  if(!x)
  return x;
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
 //^[+-]?([0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)?|\d*\.\d+|\d+)$


</script> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/user/wallet.blade.php ENDPATH**/ ?>