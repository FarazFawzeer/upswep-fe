

<?php $__env->startSection('title', 'UPSWEP - Premium Clothing'); ?>
<?php $__env->startSection('description', 'Discover premium clothing, workwear, accessories and the latest collections from UPSWEP.'); ?>

<?php $__env->startSection('content'); ?>


<div class="upswep-home">

    <?php echo $__env->make('frontend.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <section class="up-hero">
        <video class="up-hero__video" autoplay muted loop playsinline>
            <source src="<?php echo e(asset('videos/hero-video-2.mp4')); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="up-hero__content">
            <h1>CLOTHING LINE</h1>
            <a href="#" class="up-btn up-btn--light" style="color: #111111">SHOP NOW</a>
        </div>
    </section>

    
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">UPSWEP MENS</h2>
            <div class="up-circle-row">
                <?php
                    $mensCats = [
                        ['label' => 'SHIRTS', 'img' => asset('images/categories/shirt.jpg')],
                        ['label' => 'JEANS', 'img' => asset('images/categories/jeans.jpg')],
                        ['label' => 'HOODIES', 'img' => asset('images/categories/hoodies.jpg')],
                        ['label' => 'TROUSERS', 'img' => asset('images/categories/trousers.jpg')],
                        ['label' => 'FOOTWEAR', 'img' => asset('images/categories/footwear.jpg')],
                        ['label' => 'T-SHIRTS', 'img' => asset('images/categories/tshirts.jpg')],
                        ['label' => 'KNITWEAR', 'img' => asset('images/categories/kintwear.jpg')],
                        ['label' => 'ACCESSORIES', 'img' => asset('images/categories/accessories.jpg')],
                    ];
                ?>
                <?php $__currentLoopData = $mensCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="up-circle">
                        <span class="up-circle__img">
                            <img src="<?php echo e($cat['img']); ?>" alt="<?php echo e($cat['label']); ?>">
                        </span>
                        <span class="up-circle__label"><?php echo e($cat['label']); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">TRENDING NOW</h2>
            <div class="up-grid up-grid--3">
                <?php
                    $trending = [
                        ['label' => 'TOP PICKS', 'img' => asset('images/trending/17.jpg')],
                        ['label' => '', 'img' => asset('images/trending/14.jpg')],
                        ['label' => 'HOLIDAY SHOP', 'img' => asset('images/trending/11.jpg')],
                    ];
                ?>
                <?php $__currentLoopData = $trending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="up-card up-card--tall">
                        <img src="<?php echo e($card['img']); ?>" alt="<?php echo e($card['label']); ?>">
                        <span class="up-card__caption"><?php echo e($card['label']); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">STYLED FOR YOU</h2>
            <div class="up-grid up-grid--6">
                <?php
                    $styled = [
                        ['label' => 'OCCASIONWEAR', 'img' => asset('images/products/4.jpg')],
                        ['label' => 'SHACKET SEASON', 'img' => asset('images/products/33.jpg')],
                        ['label' => 'DENIM', 'img' => asset('images/products/44.jpg')],
                        ['label' => 'GRAPHIC SHOP', 'img' => asset('images/products/55.jpg')],
                        ['label' => 'SPORTSWEAR', 'img' => asset('images/products/66.jpg')],
                        ['label' => 'CARGOS', 'img' => asset('images/products/22.jpg')],
                    ];
                ?>
                <?php $__currentLoopData = $styled; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="up-card">
                        <img src="<?php echo e($card['img']); ?>" alt="<?php echo e($card['label']); ?>">
                        <span class="up-card__label"><?php echo e($card['label']); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">FEATURED</h2>
            <div class="up-grid up-grid--3">
                <?php
                    $featured = [
                        [
                            'label' => 'SMART SHOP',
                            'desc'  => 'Upgrade your wardrobe with our men’s smart shop. Perfect for any occasion, from the office to after-work drinks and special events.',
                            'img'   => asset('images/featured/22.jpg'),
                        ],
                        [
                            'label' => 'THE LINEN COLLECTION',
                            'desc'  => 'Discover our classic linen collection, including tailored shirts, lightweight shirts and easy-to-wear trousers and shorts.',
                            'img'   => asset('images/featured/28.jpg'),
                        ],
                        [
                            'label' => 'INTRODUCING COLOUR',
                            'desc'  => 'New season, new shades.',
                            'img'   => asset('images/featured/27.jpg'),
                        ],
                    ];
                ?>
                <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="up-feature-card">
                        <a href="#" class="up-feature-card__img">
                            <img src="<?php echo e($card['img']); ?>" alt="<?php echo e($card['label']); ?>">
                        </a>
                        <h3><?php echo e($card['label']); ?></h3>
                        <p><?php echo e($card['desc']); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    

    <?php echo $__env->make('frontend.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* =========================================================
       HOMEPAGE-ONLY STYLES
       Everything global (tokens, header, nav, buttons, grid base,
       footer) already lives in layouts/front.blade.php. Only the
       hero video block is unique to this page.
    ========================================================= */
    .up-hero {
        position: relative;
        height: 650px;
        overflow: hidden;
    }

    .up-hero__video {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Personal Projects\Upswep\upswep-fe\resources\views/frontend/index.blade.php ENDPATH**/ ?>