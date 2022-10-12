 <?php $__env->startSection('header'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<!-- Title bar of the content-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>برنامه این ماه شما</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i
                            ></a>
                        </li>
                        <li class="breadcrumb-item">داشبورد</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
 
      <div class="card-block row px-5">
        <div class="col-sm-12 col-lg-12 col-xl-12">
          <div class="table-responsive">
            <?php echo csrf_field(); ?>
            <table class="table table-striped dashboard-table ">
              <thead class="">
                <tr >
                  <th class="d-none d-lg-table-cell" style="font-weight: bold" scope="col">هفته</th>
                  <th style="font-weight: bold" scope="col">تاریخ</th>
                  <th style="font-weight: bold" scope="col">روز هفته</th>
                  <th style="font-weight: bold" scope="col">غذای روز</th>
                  <th style="font-weight: bold" scope="col">میزان کالری</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $weekCounter = 0;
                  $startDay = \Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($gregoryDates->startDate));
                  switch ($startDay) {
                    case 'شنبه':
                      $startRowSpan = '6';
                      break;
                    case 'یکشنبه':
                      $startRowSpan = '5';
                      break;
                    case 'دوشنبه':
                      $startRowSpan = '4';
                      break;
                    case 'سه شنبه':
                      $startRowSpan = '3';
                      break;
                    case 'چهارشنبه':
                      $startRowSpan = '2';
                      break;
                    case 'پنجشنبه':
                      $startRowSpan = '1';
                      break;
                  }
                  $week = 0;
                ?>
                <?php $__currentLoopData = $gregoryDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $row->format('D') == 'Fri' && $key !=0 ? $week++ : ''; 
                
                ?>
                <?php if($row->format('D') != 'Fri' && \App\Models\Holiday::where('date',$row)->count() == 0): ?>
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
                    case 4:
                      $weekHoroof = 'ششم';
                      break;
                  }
                  // dd($row->startOfMonth());
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
                        <?php echo e($startRowSpan - $holidayInWeek[$weekCounter]); ?>

                      <?php else: ?>
                      <?php echo e(6 - $holidayInWeek[$weekCounter]); ?>

                      <?php endif; ?>
                    " style="vertical-align: middle; font-weight:bold"> هفته <?php echo e($weekHoroof); ?></td>
                      <?php $weekCounter++ ?>
                  <?php endif; ?>
                  <td><?php echo e(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($row))); ?></td>
                  
                  <td style="font-weight: bold" scope="row"><?php echo e(\Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($row))); ?></td>
                  <td>
                  
                    <?php if( isset(Auth::user()->plan[$row->format('Y-m-d')]) ): ?>
                      <?php if(isset(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->name)): ?>
                        <?php echo e(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->name); ?>

                      <?php endif; ?>
                    <?php else: ?>
                      <?php if(isset($defaults[$weekCounter-1][\Morilog\Jalali\CalendarUtils::strftime('w', strtotime($row))])): ?>
                  
                       عدم انتخاب  (پیش فرض)
                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if(isset(Auth::user()->plan[$row->format('Y-m-d')])): ?>
                       <?php if(isset(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory)): ?>
                    	  <?php echo e(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory); ?>

                       <?php endif; ?>
                    <?php else: ?>
                      <?php if(isset($defaults[$weekCounter-1][\Morilog\Jalali\CalendarUtils::strftime('w', strtotime($row))])): ?>
                        <?php echo e(\App\Models\Plate::find($defaults[$weekCounter-1][\Morilog\Jalali\CalendarUtils::strftime('w', strtotime($row))])->calory); ?>

                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('footer'); ?> <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/user/dashboard.blade.php ENDPATH**/ ?>