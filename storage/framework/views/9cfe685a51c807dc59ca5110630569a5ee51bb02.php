 
<?php $__env->startSection('style'); ?>
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">ویرایش برنامه غذایی</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">برنامه غذایی</a></li>
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
                <form enctype="multipart/form-data" action="/admin/plans/update" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($single->id); ?>" />
                    <div class="form-group row">
                        <label for="month" class="col-md-2 col-form-label">ماه</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="month" name="month" value="<?php echo e($single->month); ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endDate" class="col-md-2 col-form-label">برنامه</label>
                        <div class="col-md-10">
                            <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>شنبه</th>
                                        <th>یکشنبه</th>
                                        <th>دوشنبه</th>
                                        <th>سه شنبه</th>
                                        <th>چهارشنبه</th>
                                        <th>پنجشنبه</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo e($i+1); ?></th>
                                            <td>پبش فرض :
                                                <select class="form-control select-multi" name="default[<?php echo e($i); ?>][0]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->default[$i][0])): ?>
                                                            
                                                                <?php echo e($item->id == $single->default[$i][0] ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[<?php echo e($i); ?>][0][]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->days[$i][0])): ?>
                                                            
                                                                <?php echo e(in_array($item->id,$single->days[$i][0]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[<?php echo e($i); ?>][0][]">
                                                    <?php $__currentLoopData = $desserts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->desserts[$i][0])): ?>
                                                            
                                                                <?php echo e(in_array($item->id,$single->desserts[$i][0]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                پبش فرض :
                                                <select class="form-control select-multi" name="default[<?php echo e($i); ?>][1]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->default[$i][1])): ?>
                                                            
                                                                <?php echo e($item->id == $single->default[$i][1] ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[<?php echo e($i); ?>][1][]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option 
                                                        <?php if(isset($single->days[$i][1])): ?>
                                                                <?php echo e(in_array($item->id,$single->days[$i][1]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[<?php echo e($i); ?>][1][]">
                                                    <?php $__currentLoopData = $desserts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->desserts[$i][1])): ?>
                                                            
                                                                <?php echo e(in_array($item->id,$single->desserts[$i][1]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                پبش فرض :
                                                <select class="form-control select-multi" name="default[<?php echo e($i); ?>][2]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->default[$i][2])): ?>
                                                            
                                                                <?php echo e($item->id == $single->default[$i][2] ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[<?php echo e($i); ?>][2][]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option 
                                                        <?php if(isset($single->days[$i][2])): ?>
                                                                <?php echo e(in_array($item->id,$single->days[$i][2]) ? 'selected=selected' : ''); ?>

                                                        <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[<?php echo e($i); ?>][2][]">
                                                    <?php $__currentLoopData = $desserts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->desserts[$i][2])): ?>
                                                            
                                                                <?php echo e(in_array($item->id,$single->desserts[$i][2]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                پبش فرض :
                                                <select class="form-control select-multi" name="default[<?php echo e($i); ?>][3]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->default[$i][3])): ?>
                                                            
                                                                <?php echo e($item->id == $single->default[$i][3] ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[<?php echo e($i); ?>][3][]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option 
                                                        <?php if(isset($single->days[$i][3])): ?>
                                                                <?php echo e(in_array($item->id,$single->days[$i][3]) ? 'selected=selected' : ''); ?>

                                                        <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[<?php echo e($i); ?>][3][]">
                                                    <?php $__currentLoopData = $desserts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->desserts[$i][3])): ?>
                                                            
                                                                <?php echo e(in_array($item->id,$single->desserts[$i][3]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                پبش فرض :
                                                <select class="form-control select-multi" name="default[<?php echo e($i); ?>][4]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->default[$i][4])): ?>
                                                            
                                                                <?php echo e($item->id == $single->default[$i][4] ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[<?php echo e($i); ?>][4][]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option 
                                                        <?php if(isset($single->days[$i][4])): ?>
                                                                <?php echo e(in_array($item->id,$single->days[$i][4]) ? 'selected=selected' : ''); ?>

                                                        <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[<?php echo e($i); ?>][4][]">
                                                    <?php $__currentLoopData = $desserts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->desserts[$i][4])): ?>
                                                            
                                                                <?php echo e(in_array($item->id,$single->desserts[$i][4]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                پبش فرض :
                                                <select class="form-control select-multi" name="default[<?php echo e($i); ?>][5]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->default[$i][5])): ?>
                                                            
                                                                <?php echo e($item->id == $single->default[$i][5] ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[<?php echo e($i); ?>][5][]">
                                                    <?php $__currentLoopData = $plates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option 
                                                        <?php if(isset($single->days[$i][5])): ?>
                                                                <?php echo e(in_array($item->id,$single->days[$i][5]) ? 'selected=selected' : ''); ?>

                                                        <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[<?php echo e($i); ?>][5][]">
                                                    <?php $__currentLoopData = $desserts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(isset($single->desserts[$i][5])): ?>
                                                            
                                                                <?php echo e(in_array($item->id,$single->desserts[$i][5]) ? 'selected=selected' : ''); ?>

                                                            <?php endif; ?>
                                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="/assets/libs/select2/select2.min.js"></script>
<script src="/assets/libs/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- init js -->
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multi').select2();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\atysa-app\resources\views/admin/plan/single.blade.php ENDPATH**/ ?>