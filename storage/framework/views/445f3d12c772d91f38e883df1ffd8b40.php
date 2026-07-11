<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.partials.page-title', ['title' => 'UPSWEP', 'subtitle' => 'Dashboard'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<div class="row">

    
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-primary bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:t-shirt-outline"
                                class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Total Products</p>
                        <h3 class="text-dark mt-2 mb-0"><?php echo e(number_format($totalProducts)); ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <?php if($productsThisMonth > 0): ?>
                            <span class="text-success">
                                <i class="bx bxs-up-arrow fs-12"></i> <?php echo e($productsThisMonth); ?> new
                            </span>
                            <span class="text-muted ms-1 fs-12">this month</span>
                        <?php else: ?>
                            <span class="text-muted fs-12">No new products this month</span>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="text-primary fs-12">View all</a>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-success bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:check-circle-outline"
                                class="fs-32 text-success avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Active Products</p>
                        <h3 class="text-dark mt-2 mb-0"><?php echo e(number_format($activeProducts)); ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <?php $inactive = $totalProducts - $activeProducts; ?>
                        <?php if($inactive > 0): ?>
                            <span class="text-warning fs-12">
                                <i class="bx bxs-error-circle fs-12"></i> <?php echo e($inactive); ?> inactive
                            </span>
                        <?php else: ?>
                            <span class="text-success fs-12">All products active</span>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('admin.products.create')); ?>" class="text-primary fs-12">Add new</a>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-info bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:chat-line-outline"
                                class="fs-32 text-info avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Total Enquiries</p>
                        <h3 class="text-dark mt-2 mb-0"><?php echo e(number_format($totalEnquiries)); ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <?php if($enquiriesThisMonth > 0): ?>
                            <span class="text-success">
                                <i class="bx bxs-up-arrow fs-12"></i> <?php echo e($enquiriesThisMonth); ?> new
                            </span>
                            <span class="text-muted ms-1 fs-12">this month</span>
                        <?php else: ?>
                            <span class="text-muted fs-12">None this month</span>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('admin.enquiries.index')); ?>" class="text-primary fs-12">View all</a>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-danger bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:bell-bing-outline"
                                class="fs-32 text-danger avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">New Enquiries</p>
                        <h3 class="text-dark mt-2 mb-0"><?php echo e(number_format($newEnquiries)); ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <?php if($newEnquiries > 0): ?>
                            <span class="text-danger fs-12">
                                <i class="bx bxs-error-circle fs-12"></i> Needs follow-up
                            </span>
                        <?php else: ?>
                            <span class="text-success fs-12">All caught up!</span>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('admin.enquiries.index')); ?>" class="text-primary fs-12">Review</a>
                </div>
            </div>
        </div>
    </div>

</div>



<div class="row">

    
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Recent Enquiries</h4>
                <a href="<?php echo e(route('admin.enquiries.index')); ?>" class="btn btn-sm btn-outline-secondary">
                    View All
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-centered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>About</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentEnquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="<?php echo e($enquiry->status === 'new' ? 'table-warning bg-opacity-25' : ''); ?>">
                                <td style="white-space:nowrap;">
                                    <?php echo e($enquiry->created_at->format('d M Y')); ?><br>
                                    <small class="text-muted"><?php echo e($enquiry->created_at->diffForHumans()); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo e($enquiry->name); ?></strong>
                                </td>
                                <td>
                                    <a href="tel:<?php echo e($enquiry->phone); ?>"><?php echo e($enquiry->phone); ?></a>
                                    <?php if($enquiry->email): ?>
                                        <br><small class="text-muted"><?php echo e($enquiry->email); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($enquiry->product): ?>
                                        <span class="badge badge-soft-primary mb-1">Product</span><br>
                                        <small><?php echo e(Str::limit($enquiry->product->name, 30)); ?></small>
                                    <?php else: ?>
                                        <span class="badge badge-soft-secondary">Contact Form</span>
                                        <?php if($enquiry->subject): ?>
                                            <br><small class="text-muted"><?php echo e($enquiry->subject); ?></small>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-soft-<?php echo e($enquiry->status === 'new' ? 'danger' : ($enquiry->status === 'contacted' ? 'warning' : 'success')); ?>">
                                        <?php echo e(ucfirst($enquiry->status)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No enquiries yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                <div class="text-muted fs-12">
                    Showing latest <?php echo e($recentEnquiries->count()); ?> of <?php echo e($totalEnquiries); ?> total enquiries
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-xl-4">

        
        <div class="card mb-3">
            <div class="card-header">
                <h4 class="card-title mb-0">Enquiry Status</h4>
            </div>
            <div class="card-body">
                <?php $totalEnq = array_sum($enquiryStats); ?>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fs-13 text-muted">New</span>
                        <span class="fs-13 fw-semibold text-danger"><?php echo e($enquiryStats['new']); ?></span>
                    </div>
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar bg-danger"
                            style="width:<?php echo e($totalEnq > 0 ? round(($enquiryStats['new'] / $totalEnq) * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fs-13 text-muted">Contacted</span>
                        <span class="fs-13 fw-semibold text-warning"><?php echo e($enquiryStats['contacted']); ?></span>
                    </div>
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar bg-warning"
                            style="width:<?php echo e($totalEnq > 0 ? round(($enquiryStats['contacted'] / $totalEnq) * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fs-13 text-muted">Closed</span>
                        <span class="fs-13 fw-semibold text-success"><?php echo e($enquiryStats['closed']); ?></span>
                    </div>
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar bg-success"
                            style="width:<?php echo e($totalEnq > 0 ? round(($enquiryStats['closed'] / $totalEnq) * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Products by Category</h4>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="text-primary fs-12">Manage</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $categoryStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item d-flex align-items-center justify-content-between px-3 py-2">
                            <div>
                                <span class="fs-13 fw-semibold"><?php echo e($cat->name); ?></span>
                                <?php if($cat->active_products_count < $cat->products_count): ?>
                                    <small class="text-muted ms-1">
                                        (<?php echo e($cat->active_products_count); ?> active)
                                    </small>
                                <?php endif; ?>
                            </div>
                            <span class="badge badge-soft-primary"><?php echo e($cat->products_count); ?></span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-muted text-center py-3">No categories yet.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if($totalCategories > 0): ?>
                <div class="card-footer py-2 text-muted fs-12">
                    <?php echo e($totalCategories); ?> <?php echo e(Str::plural('category', $totalCategories)); ?>,
                    <?php echo e($totalBrands); ?> <?php echo e(Str::plural('brand', $totalBrands)); ?>

                </div>
            <?php endif; ?>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.vertical', ['subtitle' => 'Dashboard'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Personal Projects\Upswep\upswep-fe\resources\views/index.blade.php ENDPATH**/ ?>