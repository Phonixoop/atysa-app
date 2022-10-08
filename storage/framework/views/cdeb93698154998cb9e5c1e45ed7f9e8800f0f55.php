 
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
                <form enctype="multipart/form-data" action="/company/users/update" method="POST" enctype="multipart/form-data">
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
                        <label for="email" class="col-md-2 col-form-label">نوع کاربر</label>
                        <div class="col-md-10">
                            <select class="form-control" name="isVip" id="isVip">
                                <option value="0">معمولی</option>
                                <option <?php echo e($single->isVip == 1 ? 'selected="selected"' :''); ?> value="1">VIP</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">توضیحات</label>
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
<?php echo $__env->make('layouts.company', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/company/user/single.blade.php ENDPATH**/ ?>