 
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
            <h4 class="page-title mb-0 font-size-18">نظرات</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">نظرات</a></li>
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
                    با موفقیت حذف شد.
                </div>
                <?php endif; ?>
                <?php if(Session::has('updated')): ?>
                <div class="alert alert-success" role="alert">
                    با موفقیت آپدیت شد.
                </div>
                <?php endif; ?>
                <table id="datatable2" class="table table-bordered dt-responsive datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>غذا </th>
                            <th>ظاهر کلی غذا </th>
                            <th>رنگ غذا </th>
                            <th>بافت غذا</th>
                            <th>چقدر لذت بردید</th>
                            <th>سفارش مجدد</th>
                            <th>موبایل</th>
                            <th>مشتری</th>
                            <th>تاریخ</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $poll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($row->id); ?></td>
                            <td>
                                <?php if(isset($extra[$key]['food'])): ?>
                                <?php echo e($extra[$key]['food']); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($row->zaherKolli); ?></td>
                            <td><?php echo e($row->rangeGhaza); ?></td>
                            <td>
                                <?php echo e($row->bafteGhaza); ?>

                            </td>
                            <td>
                                <?php echo e($row->cheghadrLezzat); ?>

                            </td>
                            <td>
                                <?php echo e($row->mojaddad); ?>

                            </td>
                            <td>
                                <?php echo e($row->mobile); ?>

                            </td>
                            <td>
                                <?php if(isset($extra[$key]['user'])): ?>
                                    کاربر : <?php echo e($extra[$key]['user']); ?><br/>
                                <?php endif; ?>
                                <?php if(isset($extra[$key]['company'])): ?>
                                    شرکت : <?php echo e($extra[$key]['company']); ?><br/>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d h:i:s', strtotime($row->created_at))); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody> 
                </table>
                <a class="btn btn-primary" style="width:100%" href="/admin/exportpoll" >خروجی گرفتن</a>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/admin/poll.blade.php ENDPATH**/ ?>