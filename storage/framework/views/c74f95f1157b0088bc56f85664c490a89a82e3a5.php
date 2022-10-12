 
<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>بشقاب های من</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i
                            ></a>
                        </li>
                        <li class="breadcrumb-item">بشقاب های من</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
<div class="row px-5">  
    <?php echo csrf_field(); ?>
  <table class="table table-striped text-center my-plate-table">
    <thead class="">
      <tr>
        <th style="font-weight: bold">نام بشقاب</th>
        <th style="font-weight: bold">کالری</th>
        <th style="font-weight: bold">عملیات</th>
      </tr>
    </thead>
    <tbody>
        <?php if(count($plates) > 0): ?>
        <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="below-calory " id=1>
                <td class="font-weight-bold"><?php echo e($item->name); ?></td>
                <td class="mealCalory myPlateCalory"><?php echo e($item->calory); ?></td>
                <td>
                    
                    <form method="post" action="/user/deleteplate">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="plateId" value="<?php echo e($item->id); ?>"/>
                        <button class="btn btn-pill btn-danger btn-air-danger btn-sm" >حذف</button>
                    </form>
                </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <tr class="below-calory " id=1>
            <td class="font-weight-bold" colspan="3">
                شما بشقابی برای خود نساخته اید
            </td>
        </tr>
        <?php endif; ?>
    </tbody>
  </table>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('footer'); ?>
<script>
    var defaultCalory = parseInt( $('#maxDailyCalory').text());
    console.log(defaultCalory)
    var tableLenght =($('.my-plate-table tr').length)
    for(i=1 ; i<tableLenght; i++){
        var calory = parseInt($( "#" + i  +' .myPlateCalory').text());
        if(calory > defaultCalory){
            $('#'+i).removeAttr('class').addClass('over-calory');
        }else if(calory <= defaultCalory){
            $('#'+i).removeAttr('class').addClass('below-calory'); 
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/user/allPlates.blade.php ENDPATH**/ ?>