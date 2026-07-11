<div class="app-sidebar">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo-dark">
            <img src="/images/upswep.png" class="logo-sm" alt="logo sm">
            <img src="/images/upswep.png" class="logo-lg" alt="logo dark" style="width: 150px; height: 75px;">
        </a>

        <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo-light">
            <img src="/images/upswep.png" class="logo-sm" alt="logo sm">
            <img src="/images/upswep.png" class="logo-lg" alt="logo light" style="width: 150px; height: 75px;">
        </a>
    </div>

    <div class="scrollbar" data-simplebar>

        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">Menu...</li>

            

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarAdmin" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarAdmin">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:user-circle-outline"></iconify-icon>
                    </span>
                    <span class="nav-text"> Admin</span>
                </a>
                <div class="collapse" id="sidebarAdmin">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="<?php echo e(route('second', ['admin', 'create'])); ?>">Create</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="<?php echo e(route('admin.users.index')); ?>">View </a>
                        </li>


                    </ul>
                </div>
            </li>

           
<li class="nav-item">
    <a class="nav-link menu-arrow" href="#sidebarCategories" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarCategories">
        <span class="nav-icon">
            <iconify-icon icon="solar:tag-outline"></iconify-icon>
        </span>
        <span class="nav-text">Categories</span>
    </a>
    <div class="collapse" id="sidebarCategories">
        <ul class="nav sub-navbar-nav">
            <li class="sub-nav-item">
                <a class="sub-nav-link" href="<?php echo e(route('admin.categories.index')); ?>">View All</a>
            </li>
            <li class="sub-nav-item">
                <a class="sub-nav-link" href="<?php echo e(route('admin.categories.create')); ?>">Add New</a>
            </li>
        </ul>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link menu-arrow" href="#sidebarBrands" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarBrands">
        <span class="nav-icon">
            <iconify-icon icon="solar:shop-outline"></iconify-icon>
        </span>
        <span class="nav-text">Brands</span>
    </a>
    <div class="collapse" id="sidebarBrands">
        <ul class="nav sub-navbar-nav">
            <li class="sub-nav-item">
                <a class="sub-nav-link" href="<?php echo e(route('admin.brands.index')); ?>">View All</a>
            </li>
            <li class="sub-nav-item">
                <a class="sub-nav-link" href="<?php echo e(route('admin.brands.create')); ?>">Add New</a>
            </li>
        </ul>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarProducts">
        <span class="nav-icon">
            <iconify-icon icon="solar:t-shirt-outline"></iconify-icon>
        </span>
        <span class="nav-text">Products</span>
    </a>
    <div class="collapse" id="sidebarProducts">
        <ul class="nav sub-navbar-nav">
            <li class="sub-nav-item">
                <a class="sub-nav-link" href="<?php echo e(route('admin.products.index')); ?>">View All</a>
            </li>
            <li class="sub-nav-item">
                <a class="sub-nav-link" href="<?php echo e(route('admin.products.create')); ?>">Add New</a>
            </li>
        </ul>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.enquiries.index')); ?>">
        <span class="nav-icon">
            <iconify-icon icon="solar:chat-line-outline"></iconify-icon>
        </span>
        <span class="nav-text">Enquiries</span>
    </a>
</li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.profile.edit')); ?>">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-2-outline"></iconify-icon>
                    </span>
                    <span class="nav-text"> Profile </span>

                </a>
            </li>

            
        </ul>
    </div>
</div>
<?php /**PATH F:\Personal Projects\Upswep\upswep-fe\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>