 
<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script src="/main/js/num2persian-min.js" async></script>
<style>

  
  :root 
  {
    --text-green : rgb(25, 158, 163);
  }
  
  .flex 
  {
    display: flex;
  }
  .flex-col {
    flex-direction: column;
  }
  .justify-center 
  {
    justify-content: center
  }
  .items-center 
  {
    align-items: center;
  }
  .gap-3
  {
    gap:3px;
  }
  
</style>
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
          <div class="col-6">
              <h3>سوابق تراکنش ها</h3>
          </div>
          <div class="col-6">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="/">
                          <i data-feather="home"></i
                      ></a>
                  </li>
                  <li class="breadcrumb-item">تراکنش ها</li>
              </ol>
          </div>
      </div>
  </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
   
          <?php if(isset($transactions)): ?>
          <?php $transactions = array_reverse($transactions); ?>
          <div class="col-sm-6" style="padding:0px; text-align: center; border-radius: 20px; !important; margin:0 auto; background-color: #fcffff;overflow:hideen; ">
          <table dir="rtl" class="table">
              <thead class="thead-dark">
                <tr class="">
                  <th scope="col">#</th>
                  <th scope="col  ">
                      <div class=" flex justify-center items-center">تاریخ</div>
                  </th>
                  <th scope="col   ">
                      <div class=" flex justify-center items-center">مقدار پرداختی</div>
                  </th>
                  <th scope="col ">
                      <div class=" flex justify-center items-center">وضعیت پرداخت</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                  <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php $rowStyle = $key % 2 === 0 ? "background-color: #e1eeef; border-radius:20px;" : "background-color: #ffffff" ?>
                  <tr style="<?php echo e($rowStyle); ?>">
                      <?php $date = \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($transaction["date"])); ?>
                      <th scope="row"><?php echo e($key + 1); ?></th>
                      <td >
                          <div class="flex justify-center items-center gap-3">
                              <span style="padding: 2px"><?php echo e($date->format("d M Y")); ?></span>
                            
                              <span  style="padding: 2px"><?php echo e($date->format("H:i:s")); ?></span>
                          </div>
                      </td>
                      <td >
                        <?php $amount = preg_replace("/\B(?=(\d{3})+(?!\d))/",",",$transaction["amount"]); ?> 
                          <div class="flex justify-center items-center"><?php echo e($amount); ?> تومان</div>
                      </td>
                      <td  class="flex justify-center items-center">
                  
                          <?php if($transaction["hasPayed"]): ?>
                          <div class="flex justify-center items-center" style="border: #199EA3 1px solid; width: 100px; color:#199EA3; text-align: center; border-radius: 100px; padding:5px 10px;">
                              موفق
                          </div>
                          <?php else: ?> 
                          <div class="flex justify-center items-center"  style="border: #e93939 1px dashed; color:#e93939; width: 100px; text-align: center; border-radius: 100px; padding:5px 10px;">
                              نا موفق
                          </div>
                          <?php endif; ?>     
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
              </tbody>
            </table>
          </div>
            <?php else: ?>
            <div class="col-sm-6" style="padding:0px; text-align: center; margin:0 auto;  ">
             <h3> تراکنشی وجود ندارد</h3>
              <img src="/main/images/empty_transactions.svg" />
            </div>
         <?php endif; ?>
   
      
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/user/transactions.blade.php ENDPATH**/ ?>