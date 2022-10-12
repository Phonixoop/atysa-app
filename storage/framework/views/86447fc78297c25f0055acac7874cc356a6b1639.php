 <?php $__env->startSection('header'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<!-- Title bar of the content-->
<style>
.my_alert 
{
  position: fixed;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  width: auto;
  top: 10px;

  padding:5px 10px; 
  border-radius:10px;

  color:black;
  z-index:99999999;
  font-size: 16px;
  right: 0;
  animation: slidein 1s forwards,
  opacity 7s linear forwards;

}
.good 
{
  background-color: #E6EFFA;
  border: 2px solid #3FBF61;
  box-shadow: 0px 0px 50px #ffffcc71;
}
.bad 
{
  background-color: #fae6e6;
  border: 2px solid #bf6a3f;
  box-shadow: 0px 0px 50px #ffd2cc71;
}

.icon 
{
 
  border-radius: 10px;
    margin: 0 !important;
    height: 100%;
    display: flex;
    padding: 5px;
}
.icon.success 
{
  background-color: #3FBF61;
}
.icon.faild 
{
  background-color: #bf613f;
}
.icon .icon_inner
{
  background-color: #ffffff;
  border-radius: 100000px;
   margin: 0 !important;
    height: 100%;
    padding: 4px ;
    display: flex;
}
@keyframes slidein {
  from {
    transform: translateX(1000%);
  }

  to {
 
    transform: translateX(-115px);
  
  }
}
@keyframes opacity {
    0%,{ opacity: 0;
      display:block; }
    25%,{ opacity: 1; }
    50% { opacity: 0.8; }
    100% {
       opacity: 0;
       display:none;
     }
}
</style>

<div class="page-body">
  <?php if(Session::has('message')): ?>

  <?php if(!Session('error')): ?>
    <div class="my_alert good"> 
      <span><?php echo e(Session('message')); ?></span>

      <i class="icon success">
        <i class="icon_inner">
          <svg style="width: 15px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
          </svg>
        
        </i>
      </i>
    </div>
    <?php endif; ?>

    <?php if(Session('error')): ?>
      <div class="my_alert bad"> 
        <span><?php echo e(Session('message')); ?></span>
    
        <i class="icon faild ">
          <i class="icon_inner">
            <svg  style="width: 15px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path d="M12,14a1,1,0,0,0,1-1V7a1,1,0,0,0-2,0v6A1,1,0,0,0,12,14Zm0,4a1.25,1.25,0,1,0-1.25-1.25A1.25,1.25,0,0,0,12,18Z"/>
            </svg>     
          </i>
        </i>
      </div>
    <?php endif; ?>
   <?php endif; ?>
    <div class="container-fluid">
        <div class="page-title">
          <div class="row">
            <div class="col-md-9 col-xs-12">
              <h3>انتخاب غذای ماه <span style="color:#0d6efd;font-weight:bold"><?php echo e($monthName); ?></span></h3>
                <p>دوست عزیز در صورت استفاده از رژیم غذایی منحصر به فرد می توانید از بخش <a href="/user/create-plate">ساخت بشقاب سفارشی</a> ، بشقاب مورد نظر خود را ایجاد نموده و از زبانه ی غذای روز انتخاب نمایید.</p>
            </div>
            <div class="col-md-3 col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">
                            <i data-feather="home"></i
                        ></a>
                    </li>
                    <li class="breadcrumb-item">انتخاب غذای ماه</li>
                </ol>
            </div>
        </div>
        </div>
    </div>
    <?php
    $today =\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::now())->format("d");
     $fee = 0;
     ?>
    <?php if($plateFee > 0): ?>
      <?php
      $fee =  substr($plateFee, 0, -3);
      ?>
  
    <?php endif; ?>
 

    <div class="container">
      <div class="card-block row px-5">
        <div class="col-sm-12 col-lg-12 col-xl-12">
          <div class="table-responsive">
            <form method="post" action="/user/plan" style="width: 100%;">
              <?php echo csrf_field(); ?>
             
            <table class="table table-striped dashboard-table ">
              <thead class="">
                <tr >
                  <th class="d-none d-lg-table-cell" style="font-weight: bold" scope="col">هفته</th>
                  <th style="font-weight: bold" scope="col">تاریخ</th>
                  <th style="font-weight: bold" scope="col">روز هفته</th>
                  <th width="150px" style="font-weight: bold" scope="col">غذای روز</th>
                  <th style="font-weight: bold" scope="col">میزان کالری</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  function myDayOfWeekToJalali($number){
                    switch ($number) {
                      case 0:
                        $weekHoroof = 1;
                        break;
                      case 1:
                        $weekHoroof = 2;
                        break;
                      case 2:
                        $weekHoroof = 3;
                        break;
                      case 3:
                        $weekHoroof = 4;
                        break;
                      case 4:
                        $weekHoroof = 5;
                        break;
                      case 5:
                        $weekHoroof = 6;
                        break;
                      case 6:
                        $weekHoroof = 0;
                        break;
                    }
                    return $weekHoroof;
                  }
                  $weekCounter = 0;
                  $startDay = \Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($gregoryDates->startDate));
                  switch ($startDay) {
                    case 'شنبه':
                      $startRowSpan = '5';
                      break;
                    case 'یکشنبه':
                      $startRowSpan = '4';
                      break;
                    case 'دوشنبه':
                      $startRowSpan = '3';
                      break;
                    case 'سه شنبه':
                      $startRowSpan = '2';
                      break;
                    case 'چهارشنبه':
                      $startRowSpan = '1';
                      break;
                    //case 'پنجشنبه':
                      //$startRowSpan = '1';
                      //break;
                  }
                  $week = $weekOfMonth;
                ?> 
                <?php $__currentLoopData = $gregoryDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
               <?php if($monthNumber != \Morilog\Jalali\Jalalian::fromCarbon($row)->format("m")) continue;  ?>
              
                <?php $row->format('D') == 'Fri' ? $week++ : ''; 
                ?>
                <?php if($row->format('D') != 'Fri' && $row->format('D') != 'Thu' && \App\Models\Holiday::where('date',$row)->count() == 0 ): ?>
                <?php
                  switch ($week) {
                    case 0:
                      $weekHoroof = 'اول';
                      break;
                    case 1:
                      $weekHoroof = 'دوم';
                      break;
                    case 2:
                      $weekHoroof = 'سوم';
                      break;
                    case 3:
                      $weekHoroof = 'چهارم';
                      break;
                    case 4:
                      $weekHoroof = 'پنجم';
                      break;
                    case 5:
                      $weekHoroof = 'ششم';
                      break;
                  }
                $dirooz = \Carbon\Carbon::parse($row)->subDays(1);
                $parirooz = \Carbon\Carbon::parse($row)->subDays(2);
                ?>
                <tr >
                  <?php if($row->format('D') == 'Sat' || $gregoryDates->startDate == $row || 
                  ($key != 0 && \App\Models\Holiday::where('date',$dirooz)->count() != 0 && $dirooz->format('D') == 'Sat') 
                  || 
                  ( $key > 1 && \App\Models\Holiday::where('date',$dirooz)->count() != 0 && \App\Models\Holiday::where('date',$parirooz)->count() != 0 && $parirooz->format('D') == 'Sat')
                  ): ?>
                    <td class="d-none d-lg-table-cell" rowspan="
                      <?php if($gregoryDates->startDate == $row): ?>
                        <?php echo e($startRowSpan - intval($holidayInWeek[$weekCounter])); ?>

                      <?php else: ?>
                      <?php echo e(5 - intval($holidayInWeek[$weekCounter])); ?>

                      <?php endif; ?>
                    " style="vertical-align: middle; font-weight:bold"> هفته <?php echo e($weekHoroof); ?></td>
                      <?php $weekCounter++ ?>
                  <?php endif; ?>
                  <td><?php echo e(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($row))); ?></td>
                  
                  <td style="font-weight: bold" scope="row"><?php echo e(\Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($row))); ?></td>
                  <td>
                    <div class="form-group">
                      <?php 

                  
                      $rowDay = \Morilog\Jalali\Jalalian::fromCarbon($row)->format("d");
                      ?>
                <?php if($today <  $rowDay): ?> 
                      <select name="plate[<?php echo e($row->format('Y-m-d')); ?>]" class="form-control">
                        <option value="">---انتخاب نمایید---</option>
                        
                          <?php if(isset($plan->days[$week][myDayOfWeekToJalali($row->dayOfWeek)])): ?>
                         
                          <?php $planDishes = $plan->days[$week][myDayOfWeekToJalali($row->dayOfWeek)];
                              foreach($myDishes as $row2){
                                  array_push($planDishes, $row2);
                              }
                    
                          ?>
                            <?php $__currentLoopData = $planDishes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $plate = \App\Models\Plate::find($row2); ?>
                            <option 
                            data-option
                              <?php if(isset(Auth::user()->plan[$row->format('Y-m-d')])): ?> 
                              <?php if(Auth::user()->plan[$row->format('Y-m-d')] == $row2): ?>
                                selected="selected"
                              <?php endif; ?>
                              <?php endif; ?>
                                value="<?php echo e($row2); ?>" data-calory="<?php echo e($plate->calory); ?>">
                              <?php if($plate->name): ?>
                                 <?php echo e($plate->name); ?>

                              <?php endif; ?>
                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                      </select> 
                <?php else: ?> 
               
                <?php $planDishes = $plan->days[$week][myDayOfWeekToJalali($row->dayOfWeek)];
                  foreach($myDishes as $row2){
                      array_push($planDishes, $row2);
                  }
                 
                 ?>
                <?php $__currentLoopData = $planDishes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $plate = \App\Models\Plate::find($row2); ?>
                  <?php if(Auth::user()->plan[$row->format('Y-m-d')] == null): ?>
                 <span style="color:#bf613f"> عدم انتخاب غذا</span>
                  <?php endif; ?>
                <?php if(isset(Auth::user()->plan[$row->format('Y-m-d')])): ?> 
               
                    <?php if(Auth::user()->plan[$row->format('Y-m-d')] == $row2): ?>
                    
                      <?php if($plate->name): ?>
                      <span style="color:black; font-weight: bold"><?php echo e($plate->name ?? "عدم انتخاب غذا"); ?></span>
                      <?php endif; ?>
                    <?php else: ?> 
                    here
                    <?php endif; ?>
                <?php endif; ?>
                 
              
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

                    </div>
                  </td>
                  <td class="mealCalory">
                    <?php if(isset(Auth::user()->plan[$row->format('Y-m-d')])): ?>
                       <?php if(isset(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory)): ?>
                         <?php echo e(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory); ?>

                       <?php endif; ?>
                    <?php else: ?>
                      انتخاب نشده است
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              </tbody>
            </table>
            <button class="btn btn-primary plan-submit-btn" style="width: 250px; margin:30px 0px">ثبت</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('footer'); ?> 
  <script async>
    let obj = {};
    //let budget = localStorage.getItem('budget');
    // const totalBudget = budget;
    // let seleectedCount = 0;
    // let totalFee = 0;

    // this code is working like cheeze!! . you do not have the ability to change this code
    // const fee = <?php echo e($plateFee); ?>;

    // const options =  document.querySelectorAll('[data-option]');
    // options.forEach((item)=> item.selected ? seleectedCount++ : 0);
  //  budget = totalBudget - (fee * seleectedCount);

    // const totalFeeElement =  $('[data-total-fee]');
    // const moneyText = document.querySelector('[data-money-text]');
    // localStorage.setItem('budget', budget);
    //  moneyText.textContent  = commify(budget);
  
    $(document).ready(function() {
      $('select').change(function(){
      
        var option = $('option:selected', this).attr('data-calory');
        if(option != null){
          totalFee+=fee;
          seleectedCount++;
          $(this).parent().parent().parent().find('.mealCalory').text(option);
          <?php if(Auth::user()->calory): ?>
            var myCalory = <?php echo e(Auth::user()->calory); ?>

            if(option < myCalory){
              $(this).parent().parent().parent().find('.mealCalory').css('color','green');
            }else{
              $(this).parent().parent().parent().find('.mealCalory').css('color','red');
              alert('کالری این غذا بیشتر از کالری درخواستی شما می باشد.');
            }
          <?php endif; ?>
        }else{
          totalFee-=fee;
          seleectedCount--;
          $(this).parent().parent().parent().find('.mealCalory').text('انتخاب نشده است');
          $(this).parent().parent().parent().find('.mealCalory').css('color','#000');
        }
      //   budget = totalBudget -  (fee * seleectedCount);
      // //  localStorage.setItem('budget', budget);
      //   moneyText.textContent  = commify(budget);
     
      //  totalFeeElement.text(totalFee+"");
      });
    });

    
 function commify(x) {

if(!x)
return x;
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/user/meals.blade.php ENDPATH**/ ?>