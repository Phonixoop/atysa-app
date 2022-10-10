@extends('layouts.user') 
@section('header')
@endsection
@section('content')
<script src="/main/js/num2persian-min.js" async></script>
<style>

  
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
  }
  .input_holder 
  {
    display: flex;
    flex-direction: row;
    column-gap:10px;
  }
  .result 
  {
    font-size:14px;
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
              @csrf
              <div class="current_budget">
                <h4>موجودی فعلی</h4>
                @php $budget = preg_replace("/\B(?=(\d{3})+(?!\d))/",",",$budget); @endphp 
                <h4  class="text-green">{{$budget}} تومان</h4> 
              </div>
              <div class="seperator"></div>
              <div class="choose_price">

                  {{-- <div class="column">
                    <span>مبلغ پیشنهادی</span>
                    <span class="btn_choose offered_value" onclick="btnClick(event,'{{$plateFee}}')">{{$plateFee}} تومان</span>
                    <span></span>
                  </div> --}}

                  <div class="btns_holder">
                    <span data-btn-money class="btn_choose" onclick="btnClick(event,'10000')">10,000 تومان</span>
                    <span data-btn-money class="btn_choose" onclick="btnClick(event,'20000')">20,000 تومان</span>
                    <span data-btn-money class="btn_choose" onclick="btnClick(event,'50000')">50,000 تومان</span>
                  </div>
   
              </div>
              <div class="input_holder">
                
                <span data-btn-add class="btn_addsub enabled" onclick="addPrice('10000')" >
                  <svg width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13 11h4a1 1 0 010 2h-4v4a1 1 0 01-2 0v-4H7a1 1 0 010-2h4V7a1 1 0 012 0v4z">
                      </path>
                    </svg>
                  </span>

                <input data-input autocomplete="off" class="input" placeholder="مبلغ دلخواه" value="" type="text" name="amount" id="amount" required>
                
                <span data-btn-sub class="btn_addsub" onclick="subPrice('10000')">
                  <svg  width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7 13a1 1 0 010-2h10a1 1 0 010 2H7z">
                      </path>
                  </svg>  
                </span>
              
              </div>
              <button data-btn-submit disabled class="submit">شارژ کیف پول</button>
              <p class="result"></p>
              <p class="">به مبلغ پرداختی 9 درصد مالیات بر ارزش افزوده اضافه می گردد</p>
            </form>
          </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>


<script> 

const input = document.querySelector('[data-input]');
const btnSubmit = document.querySelector('[data-btn-submit]');
const result = document.querySelector('.result');
const btns_money = document.querySelectorAll('[data-btn-money]');

const addBtn = document.querySelector('[data-btn-add]');
const subBtn = document.querySelector('[data-btn-sub]');

 // input.addEventListener('change', onChange(e.target.value));
  input.addEventListener('input', (e) => onChange(e.target.value));

const MAX_PRICE = 99999999;
const MIN_PRICE = 10000;
function parse(val) {
   const value =  val.replace(/[^0-9]/g, "") || "";

   if(value.length <= 8)
   return parseInt(value);
   return parseInt(value.substr(0, value.length - 1)) || "";
}

function addPrice(val)
{
  const value  = parse(val);
  const prev  = parse(input.value) || 0;
  const finalValue = prev + value;
  if(finalValue < MIN_PRICE || finalValue > MAX_PRICE)
      return
  onChange(finalValue);
}
function subPrice(val)
{
  const value  = parse(val);
  const prev  = parse(input.value);
  if(prev  - value < 0)
  return;
  const finalValue = prev - value;
    
  onChange(prev - value);
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
  if(!val)
  {
    disable({btnSubmit,subBtn});

    setInput("");
    return;
  }

    input.selectionStart = input.selectionEnd = 10000;

    const value  = isNaN(val) ? parse(val) || undefined : val;

    if(value < MIN_PRICE || value > MAX_PRICE)
    { 
      disable({btnSubmit,subBtn});
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
 }
 function enable({btnSubmit,subBtn})
 {
  

   btnSubmit.disabled = false;
   btnSubmit.classList.add("submit_active");

   subBtn.disabled = false;
   subBtn.classList.add("enabled");
 }
 function setInput(value)
 {
   input.value = commify(value) || "";
   if(value)
   result.textContent = Num2persian(value) + " تومان";
   else
   result.textContent ="";
 }

 function commify(x) {

  if(!x)
  return x;
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
 //^[+-]?([0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)?|\d*\.\d+|\d+)$


</script> 
@endsection
@section('footer')

@endsection

