 
<?php $__env->startSection('style'); ?>
<link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">شرکت ها</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">شرکت ها</a></li>
                    <li class="breadcrumb-item active">مشاهده همه</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if(Session::has('removed')): ?>
                <div class="alert alert-success" role="alert">
                    Removed Successfully
                </div>
                <?php endif; ?>
                <?php if(Session::has('updated')): ?>
                <div class="alert alert-success" role="alert">
                    Updated Successfully
                </div>
                <?php endif; ?>
                <table id="datatable2" class="table table-bordered dt-responsive datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            
                            <th>نام شرکت</th>
                            <th>تعداد غذاهای سفارش داده شده</th>
                            <th>هات باکس ها</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <form action="/admin/logistic/hotbox" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($row->id); ?>" />
                            
                            <td><?php echo e($row->name); ?></td>
                            <td><?php echo e(App\Models\User::where('companyId',$row->id)->where('type',5)->count()); ?></td>
                            <td>
                                <select multiple="multiple" class="form-control select-multi" name="hotboxes[]">
                                <?php $__currentLoopData = $hotboxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option 
                                    <?php if(isset($row->hotboxes) && $row->hotboxes != null): ?>
                                        <?php $__currentLoopData = $row->hotboxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e(trim($item) == trim($row2->name) ? 'selected=selected' : ''); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    value="<?php echo e(trim($row2->name)); ?>"><?php echo e(trim($row2->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-secondary waves-effect waves-light">ویرایش</button>
                            </td>
                            </form>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- Required datatable js -->
    <script src="/assets/libs/select2/select2.min.js"></script>
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
            $(document).ready(function() {
                $('.select-multi').select2();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/admin/logistic/all.blade.php ENDPATH**/ ?>