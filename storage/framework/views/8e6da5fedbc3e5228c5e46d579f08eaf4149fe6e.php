 
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
                            <th>مدیر شرکت</th>
                            <th>تعداد پرسنل</th>
                            <th>شماره تماس شرکت</th>
                            <th>پایان قرارداد</th>
                            <th>قابل استفاده است؟</th>
                            <th>بودجه شرکت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            <td><?php echo e($row->name); ?></td>
                            <td><?php echo e(isset($managers[$key]) ? $managers[$key]->name : 'ندارد'); ?></td>
                            <td><?php echo e(App\Models\User::where('companyId',$row->id)->where('type',5)->count()); ?></td>
                            <td><?php echo e($row->phone); ?></td>
                            <td><?php echo e(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($row->endDate))); ?></td>
                            <td <?php echo e($row->enable ? 'بله' : 'style=color:red'); ?> ><?php echo e($row->enable ? 'بله' : 'خیر'); ?></td>
                            <td><?php echo e($row->plateFee); ?></td>
                            <td>
                                <form action="/admin/companies/delete" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($row->id); ?>" />
                                    <button type="button" class="btn btn-danger waves-effect waves-light deleteButton">حذف</button>
                                </form>
                                <a href="/admin/companies/single/<?php echo e($row->id); ?>" class="btn btn-secondary waves-effect waves-light">ویرایش</a>
                                <a href="/admin/companies/personels/<?php echo e($row->id); ?>" class="btn btn-primary waves-effect waves-light">مشاهده کاربران</a>
                                <a href="/admin/companies/sidedish/<?php echo e($row->id); ?>" class="btn btn-warning waves-effect waves-light">مشاهده پیش غذا</a>
                                <a href="/admin/companies/users/daily/<?php echo e($row->id); ?>" class="btn btn-success waves-effect waves-light">ریز سفارش های امروز</a>
                                <a href="/admin/companies/users/endofmonth/<?php echo e($row->id); ?>" class="btn btn-success waves-effect waves-light">ریز سفارش های تا آخر ماه</a>
                            </td>
                          
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
            $('.deleteButton').click(function(){
                var me = $(this);
                if (confirm("آیا اطمینان دارین؟")) {
                    me.parent().submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/admin/company/all.blade.php ENDPATH**/ ?>