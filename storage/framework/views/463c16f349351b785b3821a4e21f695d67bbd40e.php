 
<?php $__env->startSection('style'); ?>
<link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18"> برنامه غذایی 
                <span style="color: #1D9FA4;;"> <?php echo e($single->name); ?></span>
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">برنامه غذایی</a></li>
                    <li class="breadcrumb-item active">مشاهده همه</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php $url = "/admin/plans/single/".$single->id."/months/new"  ?>
        <a href="<?php echo e($url); ?>" style="color:white; margin:5px" class="btn btn-primary waves-effect waves-light">افزودن ماه</a>
        <div class="card" style="border-radius: 20px;">
            <div class="card-body" >
                <?php if(Session::has('removed')): ?>
                <div class="alert alert-success" role="alert">
                    با موفقیت حذف شد.
                </div>
                <?php endif; ?>
                <?php if(Session::has('updated')): ?>
                <div class="alert alert-success" role="alert">
                    با موفقیت آپدیت شد.
                </div>
                <?php endif; ?>
                <table  id="datatable2" class="table table-bordered  dt-responsive datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            
                            <th>ماه</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <?php if(isset($single->months)): ?>
                            <?php $__currentLoopData = $single->months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                
                        
                                <td><?php echo e($row["month"]); ?></td>
                                <td>
                                 <div style="display: flex; gap:5px;">
                                        <form action="/admin/plans/months/delete" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="planId" value="<?php echo e($single->id); ?>" />
                                            <input type="hidden" name="monthId" value="<?php echo e($row["id"]); ?>" />
                                            <input type="hidden" name="month" value="<?php echo e($row["month"]); ?>" />
                                            <button style="border-radius: 20px;" type="submit" class="btn btn-danger waves-effect waves-light">حذف</button>
                                        </form>
                                        <a style="border-radius: 20px;" href="/admin/plans/months/single/<?php echo e($single->id); ?>/<?php echo e($row["month"]); ?>" class="btn btn-secondary waves-effect waves-light">ویرایش</a>
                                    </div> 
                                </td>
                            
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- Required datatable js -->
    <script src="/assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables/dataTables.bootstrap4.js"></script>
    <!-- Buttons examples -->
    <script src="/assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    
    <script src="/assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="/assets/libs/datatables/buttons.print.min.js"></script>
    <!-- Responsive examples -->
    <script src="/assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable2').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fa.json'
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/admin/plan/month/all.blade.php ENDPATH**/ ?>