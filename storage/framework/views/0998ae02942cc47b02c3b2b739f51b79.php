

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
            <a href="<?php echo e(url('/products')); ?>" class="up-btn up-btn--light" style="color: #111111">SHOP NOW</a>
        </div>
    </section>

    
    <?php if($categories->isNotEmpty()): ?>
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">UPSWEP MENS</h2>
                <div class="up-circle-row">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(url('/products?category=' . $cat->slug)); ?>" class="up-circle">
                            <span class="up-circle__img">
                                <?php if($cat->image): ?>
                                    
                                    
                                    <img src="<?php echo e(img_url($cat->image)); ?>" alt="<?php echo e($cat->name); ?>">
                                <?php else: ?>
                                    <span class="up-circle__placeholder">
                                        <?php echo e(strtoupper(substr($cat->name, 0, 1))); ?>

                                    </span>
                                <?php endif; ?>
                            </span>
                            <span class="up-circle__label"><?php echo e(strtoupper($cat->name)); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if($trending->isNotEmpty()): ?>
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">TRENDING NOW</h2>
                <div class="up-grid up-grid--3">
                    <?php $__currentLoopData = $trending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(url('/product/' . $product->slug)); ?>" class="up-card up-card--tall">
                            <?php if($product->main_image): ?>
                                <img src="<?php echo e(img_url($product->main_image)); ?>" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                                <div class="up-card__no-image">
                                    <span><?php echo e(strtoupper(substr($product->name, 0, 1))); ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="up-card__caption"><?php echo e(strtoupper($product->name)); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if($styled->isNotEmpty()): ?>
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">STYLED FOR YOU</h2>
                <div class="up-grid up-grid--6">
                    <?php $__currentLoopData = $styled; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(url('/product/' . $product->slug)); ?>" class="up-card">
                            <?php if($product->main_image): ?>
                                <img src="<?php echo e(img_url($product->main_image)); ?>" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                                <div class="up-card__no-image">
                                    <span><?php echo e(strtoupper(substr($product->name, 0, 1))); ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="up-card__label"><?php echo e(strtoupper($product->name)); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    
    <?php if($featured->isNotEmpty()): ?>
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">FEATURED</h2>
                <div class="up-grid up-grid--3">
                    <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="up-feature-card">
                            <a href="<?php echo e(url('/product/' . $product->slug)); ?>" class="up-feature-card__img">
                                <?php if($product->main_image): ?>
                                    <img src="<?php echo e(img_url($product->main_image)); ?>" alt="<?php echo e($product->name); ?>">
                                <?php else: ?>
                                    <div class="up-card__no-image up-card__no-image--tall">
                                        <span><?php echo e(strtoupper(substr($product->name, 0, 1))); ?></span>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <h3><?php echo e(strtoupper($product->name)); ?></h3>
                            <p><?php echo e($product->description); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php echo $__env->make('frontend.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
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

    /* ---- Hero content: always absolutely positioned over the video ---- */
    .up-hero__content {
        position: absolute;
        left: 40px;
        bottom: 48px;
        color: #fff;
        z-index: 2;
    }

    .up-hero__content h1 {
        font-size: 42px;
        font-weight: 700;
        letter-spacing: .04em;
        margin: 0 0 18px;
        text-shadow: 0 2px 12px rgba(0,0,0,.35);
        line-height: 1.1;
    }

    .up-card__no-image {
        width: 100%;
        height: 100%;
        background: #f0eee8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
        color: #c9c5b8;
        letter-spacing: .04em;
    }

    .up-card__no-image--tall {
        aspect-ratio: 7/9;
    }

    .up-circle__placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        background: #e6e3da;
        font-size: 22px;
        font-weight: 700;
        color: #9a9890;
    }

    /* =========================================================
       Responsive : mobile (<=768px)
    ========================================================= */
    @media (max-width: 768px) {

        /* --- Container: tighter padding on small screens --- */
        .up-container {
            padding: 0 16px;
        }

        /* --- Hero: shorter on mobile, content centered --- */
        .up-hero {
            height: 380px;
        }
        .up-hero__content {
            left: 0;
            right: 0;
            bottom: 32px;
            text-align: center;
            padding: 0 24px;
        }
        .up-hero__content h1 {
            font-size: 26px;
            letter-spacing: .03em;
            margin-bottom: 14px;
        }
        .up-hero__content .up-btn {
            padding: 10px 22px;
            font-size: 11px;
        }

        /* --- Sections: less vertical padding --- */
        .up-section {
            padding: 24px 0;
        }
        .up-section__title {
            font-size: 16px;
            margin-bottom: 14px !important;
        }

        /* --- Category circles: single horizontal scroll row --- */
        .up-circle-row {
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            overflow-y: visible !important;
            justify-content: flex-start !important;
            gap: 16px;
            padding-bottom: 8px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .up-circle-row::-webkit-scrollbar { display: none; }
        .up-circle {
            width: 80px;
            flex: 0 0 auto;
        }
        .up-circle__img {
            width: 80px;
            height: 80px;
            margin-bottom: 8px;
        }
        .up-circle__label { font-size: 10px; }

        /* --- Grids: tighter gaps on mobile --- */
        .up-grid { gap: 10px; }

        /* --- Styled For You labels --- */
        .up-card__label {
            font-size: 9.5px;
            margin-top: 5px;
        }
        .up-card--tall .up-card__caption {
            font-size: 11px;
            left: 10px;
            bottom: 10px;
        }

        /* --- Feature cards --- */
        .up-feature-card h3 {
            font-size: 14px;
            margin: 10px 0 4px;
        }
        .up-feature-card p {
            font-size: 11.5px;
            line-height: 1.5;
        }

        /* --- Footer bottom: single column on very small --- */
        .up-footer-bottom__cols {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 420px) {
        .up-hero { height: 320px; }
        .up-hero__content h1 { font-size: 20px; margin-bottom: 12px; }
        .up-circle { width: 70px; }
        .up-circle__img { width: 70px; height: 70px; }
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Personal Projects\Upswep\upswep-fe\resources\views/frontend/index.blade.php ENDPATH**/ ?>