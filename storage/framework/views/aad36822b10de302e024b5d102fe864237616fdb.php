 
<?php $__env->startSection('style'); ?>
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">کاربران</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">کاربران</a></li>
                    <li class="breadcrumb-item active">ویرایش</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" action="/admin/users/update" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php if($errors->any()): ?>
                        <p  class="text-danger mb-4 mt-3"><?php echo e($errors->first()); ?></p>
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?php echo e($single->id); ?>" />
                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">نام</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="name" name="name" value="<?php echo e($single->name); ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyId" class="col-md-2 col-form-label">شرکت</label>
                        <div class="col-md-10">
                            <select class="form-control" name="companyId" id="companyId">
                                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($com->id == $single->companyId): ?> selected="selected" <?php endif; ?>  value="<?php echo e($com->id); ?>"><?php echo e($com->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">نوع کاربر</label>
                        <div class="col-md-10">
                            <select class="form-control" name="type" id="type">
                                <option <?php echo e($single->type == 1 ? 'selected="selected"' : ""); ?> value="1"> ادمین</option>
                                <option <?php echo e($single->type == 2 ? 'selected="selected"' : ""); ?> value="2">کارشناس فروش</option>
                                <option <?php echo e($single->type == 4 ? 'selected="selected"' : ""); ?> value="4">مدیر شرکت</option>
                                <option <?php echo e($single->type == 5 ? 'selected="selected"' : ""); ?> value="5">کارمند</option>
                                <option <?php echo e($single->type == 6 ? 'selected="selected"' : ""); ?> value="6">لوجستیک</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">آدرس ایمیل</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="email" name="email" value="<?php echo e($single->email); ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-md-2 col-form-label">شماره موبایل</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="mobile" name="mobile" value="<?php echo e($single->mobile); ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label">پسورد جدید</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="password" name="password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">ویرایش</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userId').select2();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/admin/user/single.blade.php ENDPATH**/ ?>