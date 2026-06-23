

<?php $__env->startSection('title', 'UPSWEP CLOHING LINE '); ?>

<?php $__env->startSection('content'); ?>

    

    <style>

        @media (max-width: 767px) {
    .up-social-like,
    .up-checkout-btn {
        display: none !important;
    }
}
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

        .up-logo {
            font-family: next-display-700, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
            font-size: 28px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>

    <div class="upswep-home">

        
        <div class="up-topbar">
            <div class="up-topbar__inner">
                <span>We accept</span>
                <span class="up-pay-icons">
                    <img src="<?php echo e(asset('images/visa.png')); ?>" alt="Visa" style="height: 14px;">
                </span>
            </div>
        </div>

        
        <header class="up-header">
            <div class="up-header__row up-header__row--top">
                <div class="up-search">
                    <input type="text" placeholder="Search for anything here...">
                    <button type="button" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg"
     width="18"
     height="18"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="1.5"
     stroke-linecap="round"
     stroke-linejoin="round">
    <circle cx="10.5" cy="10.5" r="6.5"></circle>
    <path d="M15.5 15.5L21 21"></path>
</svg>
                    </button>
                </div>

                <a href="<?php echo e(url('/')); ?>" class="up-logo">UPSWEP</a>
                

                <div class="up-header__icons">
                    <a href="#" aria-label="Wishlist" class="up-social-like">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <path
                                d="M12 21s-7.5-4.6-10-9.3C.6 8.2 2.4 4.5 6 4c2.2-.3 4.2 1 6 3.1C13.8 5 15.8 3.7 18 4c3.6.5 5.4 4.2 4 7.7C19.5 16.4 12 21 12 21z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Account">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <circle cx="12" cy="8" r="3.4" />
                            <path d="M4.5 20c1.3-3.6 4.4-5.6 7.5-5.6s6.2 2 7.5 5.6" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Bag" >
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <path d="M6 8h12l-1 12H7L6 8z" />
                            <path d="M9 8V6a3 3 0 0 1 6 0v2" />
                        </svg>
                    </a>
                    <button type="button" class="up-checkout-btn">CHECKOUT</button>
                </div>
            </div>

            <nav class="up-header__row up-header__row--nav">
                <ul class="up-nav">
                    <li><a href="#" class="is-active">HOME</a></li>
                    <li><a href="#">PRODUCTS</a></li>
                    <li><a href="#">BRANDS</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </nav>
        </header>

        
        <section class="up-hero">
            <video class="up-hero__video" autoplay muted loop playsinline>
                <source src="<?php echo e(asset('videos/hero-video-2.mp4')); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="up-hero__content">
                <h1>CLOTHING LINE</h1>
                <a href="#" class="up-btn up-btn--light " style="color: #111111">SHOP NOW</a>
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
                            [
                                'label' => 'TOP PICKS',
                                'img' => asset('images/trending/top-picks.jpeg'),
                            ],
                            [
                                'label' => 'TRENDING TEXTURES',
                                'img' => asset('images/trending/trending-textures.jpeg'),
                            ],
                            [
                                'label' => 'HOLIDAY SHOP',
                                'img' => asset('images/trending/holiday-shop.jpeg'),
                            ],
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
                            [
                                'label' => 'OCCASIONWEAR',
                                'img' => asset('images/featured/1.jpeg'),
                            ],
                            [
                                'label' => 'SHACKET SEASON',
                                'img' => asset('images/featured/2.jpeg'),
                            ],
                            ['label' => 'DENIM', 'img' => asset('images/featured/3.jpeg')],
                            [
                                'label' => 'GRAPHIC SHOP',
                                'img' => asset('images/featured/4.jpeg'),
                            ],
                            ['label' => 'SPORTSWEAR', 'img' => asset('images/featured/5.jpeg')],
                            ['label' => 'CARGOS', 'img' => asset('images/featured/6.jpeg')],
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
                                'desc' =>
                                    'Upgrade your wardrobe with our men’s smart shop. Perfect for any occasion, from the office to after-work drinks and special events.',
                                'img' => asset('images/featured/22.jpg'),
                            ],
                            [
                                'label' => 'THE LINEN COLLECTION',
                                'desc' =>
                                    'Discover our classic linen collection, including tailored shirts, lightweight shirts and easy-to-wear trousers and shorts.',
                                'img' => asset('images/featured/28.jpg'),
                            ],
                            [
                                'label' => 'INTRODUCING COLOUR',
                                'desc' => 'New season, new shades.',
                                'img' => asset('images/featured/27.jpg'),
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

        
        <section class="up-section">
            <div class="up-container">
                <div class="up-section__head">
                    <h2 class="up-section__title up-section__title--inline">DISCOVER BRANDS</h2>
                    <a href="#" class="up-btn up-btn--outline up-btn--sm">SHOP ALL BRANDS</a>
                </div>
                <div class="up-grid up-grid--3">
                    <?php
                        $brands = [
                            ['label' => '', 'img' => asset('images/featured/35.jpg')],
                            ['label' => '', 'img' => asset('images/featured/30.jpg')],
                            [
                                'label' => '',
                                'img' => asset('images/featured/33.jpg'),
                            ],
                        ];
                    ?>
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#" class="up-card up-card--tall">
                            <img src="<?php echo e($card['img']); ?>" alt="<?php echo e($card['label']); ?>">
                            <span class="up-card__caption"><?php echo e($card['label']); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        
        <footer class="up-footer-bottom">
            <div class="up-container">
                <p class="up-footer-bottom__social-title">Our Social Networks</p>
                <div class="up-social-row">
                    <a href="#" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="#" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>

                    <a href="#" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>

                <div class="up-footer-bottom__cols">
                    <div class="up-footer-bottom__account">
                        <p><strong>My Account</strong><br>Sign in to your account</p>
                        <button type="button" class="up-lang-switch">
                            <span>Select Language</span>
                            <span class="up-lang-switch__opts">En | Si</span>
                        </button>
                    </div>

                    <div class="up-footer-bottom__col">
                        <h5>Help</h5>
                        <ul>
                            <li><a href="#">Returns Information</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Product Recall</a></li>
                        </ul>
                    </div>

                    <div class="up-footer-bottom__col">
                        <h5>Privacy & Legal</h5>
                        <ul>
                            <li><a href="#">Privacy and Cookie Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Customer Reviews & Ratings Policy</a></li>
                        </ul>
                    </div>

                    <div class="up-footer-bottom__col">
                        <h5>Departments</h5>
                        <ul>

                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Boys</a></li>

                            <li><a href="#">Home</a></li>
                            <li><a href="#">Brands</a></li>
                        </ul>
                    </div>

                    <div class="up-footer-bottom__col">
                        <h5>Other Services</h5>
                        <ul>
                            <li><a href="#">Media & Press</a></li>
                            <li><a href="#">The Company</a></li>
                            <li><a href="#">UPSWEP Careers</a></li>
                        </ul>
                    </div>
                </div>

                <p class="up-footer-bottom__copy">© <?php echo e(date('Y')); ?> UPSWEP Retail Ltd. All rights reserved.</p>
            </div>
        </footer>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        /* =========================================================
                   UPSWEP HOMEPAGE STYLES — scoped under .upswep-home
                   Tuned for a clean, professional, NEXT-style retail look:
                   lighter weights, tighter type, restrained letter-spacing.
                ========================================================= */
        .upswep-home {
            --up-black: #111111;
            --up-dark: #1a1a1a;
            --up-bg: #f7f6f3;
            --up-line: #e6e3da;
            --up-text: #1a1a1a;
            --up-muted: #767676;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: var(--up-text);
            background: #fff;
            font-size: 14px;
            line-height: 1.45;
            -webkit-font-smoothing: antialiased;
        }

        .upswep-home * {
            box-sizing: border-box;
        }

        .upswep-home a {
            text-decoration: none;
            color: inherit;
        }

        .upswep-home ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .upswep-home img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .upswep-home p {
            margin: 0;
        }

        .upswep-home h1,
        .upswep-home h2,
        .upswep-home h3,
        .upswep-home h4,
        .upswep-home h5 {
            margin: 0;
        }

        .up-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ---- Topbar ---- */
        .up-topbar {
            background: var(--up-black);
            color: #fff;
        }

        .up-topbar__inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 7px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: .02em;
            font-size: 10.5px;
            font-weight: 500;
        }

        .up-pay-icons {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ---- Header ---- */
        .up-header {
            border-bottom: 1px solid var(--up-line);
            background: #fff;
        }

        .up-header__row {
            display: flex !important;
            align-items: center;
            padding: 14px 24px;
            gap: 24px;
            max-width: 1400px;
            margin: 0 auto;
            flex-wrap: nowrap;
        }

        .up-header__row--top {
            justify-content: space-between;
        }

        .up-search {
            flex: 1 1 auto;
            max-width: 240px;
            position: relative;
        }

        .up-search input {
            width: 100%;
            padding: 8px 34px 8px 14px;
            border: 1px solid #d4d1c8;
            border-radius: 2px;
            font-size: 14px;
            outline: none;
            background: #fafaf8;
        }

        .up-search input::placeholder {
            color: #9a9890;
        }

        .up-search button {
            position: absolute;
            right: 7px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: 1px #111111;
            cursor: pointer;
            color: none;
        }

        .up-logo {
            font-weight: 700;
            font-size: 20px;
            letter-spacing: .14em;
            text-align: center;
            white-space: nowrap;
        }

        .up-header__icons {
            display: flex !important;
            align-items: center;
            gap: 16px;
            flex: 0 0 auto;
            flex-wrap: nowrap;
        }

        .up-header__icons a {
            color: var(--up-text);
            display: flex;
            opacity: .85;
        }

        .up-header__icons a:hover {
            opacity: 1;
        }

        .up-checkout-btn {
            background: #d9d5c8;
            border: none;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: .04em;
            cursor: pointer;
            border-radius: 2px;
            white-space: nowrap;
            color: #1a1a1a;
        }

        .up-checkout-btn:hover {
            background: #ccc7b6;
        }

        .up-header__row--nav {
            padding: 11px 24px;
            justify-content: center;
            margin-top: -16px;
        }

        .up-nav {
            display: flex !important;
            gap: 48px;
            flex-wrap: wrap;
        }

        .up-nav li {
            display: inline-flex !important;
        }

        .up-nav a {
            font-family: next-display-700, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
            display: inline-block;
            font-size: 0.9375rem;
            font-weight: 600;
            letter-spacing: .06em;
            padding: 4px 2px;
            border-bottom: 1.5px solid transparent;
            color: rgba(0, 0, 0, 1) !important;
        }

        .up-nav a:hover,
        .up-nav a.is-active {
            border-color: var(--up-black);
            color: var(--up-black);
        }

        /* ---- Hero ---- */
        .up-hero {
            position: relative;
            overflow: hidden;
        }

        .up-hero img {
            width: 100%;
            height: 520px;
            object-fit: cover;
        }

        .up-hero__content {
            position: absolute;
            left: 28px;
            bottom: 36px;
            color: #fff;
        }

        .up-hero__content h1 {
            font-size: 38px;
            font-weight: 700;
            letter-spacing: .02em;
            margin: 0 0 14px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, .3);
        }

        .up-btn {
            display: inline-block;
            padding: 11px 24px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .04em;
            border-radius: 2px;
            transition: background .15s, color .15s;
        }

        .up-btn--light {
            background: #fff;
            color: var(--up-black);
        }

        .up-btn--light:hover {
            background: var(--up-black);
            color: #fff;
        }

        .up-btn--outline {
            border: 1px solid var(--up-black);
            background: transparent;
            font-weight: 600;
        }

        .up-btn--outline:hover {
            background: var(--up-black);
            color: #fff;
        }

        .up-btn--sm {
            padding: 8px 16px;
            font-size: 14px;
        }

        /* ---- Sections ---- */
        .up-section {
            padding: 36px 0;
            background: var(--up-bg);
        }

        .up-section:nth-of-type(odd) {
            background: #fff;
        }

        .up-section__title {
            font-size: 23px;
            font-weight: 600;
            letter-spacing: .05em;
            margin: 0 0 16px;
            text-transform: uppercase;
            color: #222222;
            margin-bottom: 24px !important;
        }

        .up-section__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .up-section__title--inline {
            margin-bottom: 0;
        }

        /* ---- Circle row ---- */
        .up-circle-row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 35px;
            overflow: visible;
        }

        .up-circle {
            width: 130px;
            text-align: center;
        }

        .up-circle__img {
            width: 140px;
            height: 140px;
            border-radius: 50% !important;
            overflow: hidden;
            margin: 0 auto 12px;
            display: block;
        }

        .up-circle__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50% !important;
            display: block;
        }

        .up-circle__label {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
            text-transform: uppercase;
            text-align: center;
        }

        .up-circle:hover .up-circle__img {
            box-shadow: 0 0 0 1.5px var(--up-black);
        }

        /* ---- Grids ---- */
        .up-grid {
            display: grid !important;
            gap: 14px;
        }

        .up-grid--3 {
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        }

        .up-grid--6 {
            grid-template-columns: repeat(6, minmax(0, 1fr)) !important;
        }

        .up-card {
            position: relative;
            display: block;
            overflow: hidden;
            background: #eee;
        }

        .up-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .up-card:hover img {
            transform: scale(1.04);
        }

        .up-card--tall {
            aspect-ratio: 7/9;
        }

        .up-card--tall .up-card__caption {
            position: absolute;
            left: 14px;
            bottom: 14px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .03em;
            text-shadow: 0 1px 6px rgba(0, 0, 0, .45);
        }

        .up-grid--6 .up-card {
            aspect-ratio: 4/5;
        }

        .up-card__label {
            display: block;
            margin-top: 8px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .03em;
            text-transform: uppercase;
            text-align: left;
            color: #3a3a3a;
        }

        /* ---- Feature cards ---- */
        .up-feature-card h3 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: .03em;
            margin: 12px 0 5px;
            text-transform: uppercase;
            color: #2a2a2a;
        }

        .up-feature-card p {
            font-size: 12px;
            color: var(--up-muted);
            line-height: 1.5;
            margin: 0;
        }

        .up-feature-card__img {
            display: block;
            aspect-ratio: 7/9;
            overflow: hidden;
            background: #eee;
        }

        .up-feature-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .up-feature-card__img:hover img {
            transform: scale(1.04);
        }

        /* ---- Footer links ---- */
        .up-footer-links {
            background: #fff;
            padding: 40px 0 20px;
            border-top: 1px solid var(--up-line);
        }

        .up-footer-links__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px 24px;
        }

        .up-footer-links__col h4 {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .04em;
            margin: 0 0 10px;
            border-bottom: 1px solid var(--up-line);
            padding-bottom: 7px;
            color: #2a2a2a;
        }

        .up-footer-links__col li {
            margin-bottom: 6px;
        }

        .up-footer-links__col a {
            font-size: 11px;
            color: var(--up-muted);
        }

        .up-footer-links__col a:hover {
            color: var(--up-black);
            text-decoration: underline;
        }

        /* ---- Footer bottom ---- */
        .up-footer-bottom {
            background: var(--up-black);
            color: #bbb;
            padding: 32px 0 20px;
            font-size: 11px;
        }

        .up-footer-bottom__social-title {
            text-align: center;
            color: #fff;
            font-weight: 600;
            letter-spacing: .03em;
            font-size: 11px;
            margin-bottom: 14px !important;
        }

        .up-social-row {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .up-social-row a {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #262626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 600;
            color: #fff;
        }

        .up-social-row a:hover {
            background: #3a3a3a;
        }

        .up-footer-bottom__cols {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1fr 1fr;
            gap: 24px;
            border-top: 1px solid #2a2a2a;
            padding-top: 22px;
        }

        .up-footer-bottom__account p {
            margin: 0 0 12px;
            line-height: 1.5;
            color: #ccc;
        }

        .up-lang-switch {
            background: none;
            border: 1px solid #3a3a3a;
            color: #bbb;
            padding: 7px 11px;
            font-size: 10.5px;
            border-radius: 2px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            width: 100%;
            gap: 8px;
        }

        .up-footer-bottom__col h5 {
            color: #fff;
            font-size: 11px;
            margin: 0 0 10px;
            font-weight: 600;
        }

        .up-footer-bottom__col li {
            margin-bottom: 7px;
        }

        .up-footer-bottom__col a {
            color: #bbb;
        }

        .up-footer-bottom__col a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .up-footer-bottom__copy {
            text-align: center;
            color: #777;
            margin-top: 24px;
            font-size: 10px;
        }

        /* ---- Responsive : tablet ---- */
        @media (max-width: 1100px) {
            .up-grid--6 {
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            }

            .up-footer-links__grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .up-footer-bottom__cols {
                grid-template-columns: 1fr 1fr 1fr;
            }
        }

        /* ====================================================================
           ---- Responsive : mobile (<=768px) ----
           Header rebuilt as: row 1 = icon-trigger search + centered logo + icons,
           row 2 = full-width search input (hidden until tapped), row 3 = nav row.
           This replaces the old wrap-everything approach which crowded the logo,
           shifted it off-center, and let the nav overlap the row above it.
        ==================================================================== */
        @media (max-width: 768px) {

            .up-topbar__inner {
                padding: 6px 16px;
                font-size: 9.5px;
                gap: 6px;
            }

            .up-container {
                padding: 0 16px;
            }

            /* --- Top row: 3 equal grid columns guarantee true centering ---
               search+wishlist (left) | logo (center) | account+bag+checkout (right)
               Grid removes the flex-balancing problem entirely: the center
               column is always the literal middle third of the row, no
               matter how wide the left/right content is.

               The Wishlist link lives in the HTML inside .up-header__icons
               (alongside Account/Bag/Checkout) so the DOM/desktop structure
               stays untouched. On mobile only, it's pulled out visually
               with position:absolute and anchored beside the search icon —
               matching the reference: [search, wishlist] | LOGO |
               [account, bag, checkout]. Grid-column placement can't reach
               it directly since it's nested inside the flex icon cluster,
               not a direct grid child — absolute positioning sidesteps
               that nesting limit cleanly. */
            .up-header__row--top {
                display: grid !important;
                grid-template-columns: 1fr auto 1fr;
                align-items: center;
                padding: 12px 16px;
                gap: 10px;
                flex-wrap: nowrap !important;
                position: relative;
            }

            .up-logo {
                grid-column: 2;
                justify-self: center;
                font-size: 18px;
                letter-spacing: .1em;
                text-align: center;
                white-space: nowrap;
            }

            /* Left slot: just the search trigger icon */
            .up-search {
                grid-column: 1;
                justify-self: start;
                flex: 0 0 auto;
                max-width: none;
                width: auto;
            }

            .up-search input {
                display: none;
            }

            .up-search.is-open input {
                display: block;
            }

            .up-search.is-open {
                position: absolute;
                left: 12px;
                right: 12px;
                top: 100%;
                margin-top: 6px;
                z-index: 20;
                background: #fff;
                padding: 8px 0;
            }

            .up-search button {
                position: static;
                transform: none;
                width: 28px;
                height: 28px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--up-text);
            }

            .up-header {
                position: relative;
            }

            /* Wishlist visually joins the search icon on the left, even
               though it stays in its original spot in the DOM/HTML. */
            .up-header__icons a[aria-label="Wishlist"] {
                position: absolute;
                left: 38px;
                top: 50%;
                transform: translateY(-50%);
            }

            .up-header__icons a[aria-label="Wishlist"] svg {
                width: 20px;
                height: 20px;
            }

            .up-header__icons {
                grid-column: 3;
                justify-self: end;
                display: flex !important;
                gap: 10px;
                position: relative;
            }


            .up-header__icons a svg {
                width: 20px;
                height: 20px;
            }

            /* Shrink the checkout button so it doesn't crowd the icon row */
            .up-checkout-btn {
                padding: 7px 12px;
                font-size: 10.5px;
                letter-spacing: .02em;
            }

            /* --- Nav row: 4 links spread evenly edge-to-edge --- */
            .up-header__row--nav {
                display: block !important;
                margin-top: 0;
                padding: 9px 16px;
                border-top: 1px solid var(--up-line);
            }

            .up-nav {
                display: flex !important;
                width: 100%;
                gap: 0;
                justify-content: space-between !important;
                flex-wrap: nowrap;
            }

            .up-nav li {
                flex: 1 1 0;
                text-align: center;
                display: flex !important;
                justify-content: center;
            }

            .up-nav a {
                font-size: 11.5px;
                letter-spacing: .02em;
                padding: 4px 2px;
                white-space: nowrap;
            }

            .up-grid--3 {
                grid-template-columns: minmax(0, 1fr) !important;
            }

            .up-grid--6 {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }

            .up-footer-links__grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .up-footer-bottom__cols {
                grid-template-columns: 1fr 1fr;
            }

            .up-hero__content h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 420px) {
            .up-nav a {
                font-size: 10.5px;
            }

            .up-checkout-btn {
                padding: 6px 10px;
                font-size: 10px;
            }

            .up-header__icons {
                gap: 8px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // =========================================================
        // UPSWEP HOMEPAGE JS
        // - mobile-friendly drag-scroll for circle rows
        // - mobile search icon toggle (expands input below header)
        // - simple checkout button placeholder action
        // =========================================================
        document.addEventListener('DOMContentLoaded', function() {

            // Drag-to-scroll for circle rows (mouse + touch already native via overflow-x)
            document.querySelectorAll('.up-circle-row').forEach(function(row) {
                let isDown = false,
                    startX, scrollLeft;

                row.addEventListener('mousedown', function(e) {
                    isDown = true;
                    row.classList.add('is-dragging');
                    startX = e.pageX - row.offsetLeft;
                    scrollLeft = row.scrollLeft;
                });
                row.addEventListener('mouseleave', function() {
                    isDown = false;
                });
                row.addEventListener('mouseup', function() {
                    isDown = false;
                });
                row.addEventListener('mousemove', function(e) {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - row.offsetLeft;
                    const walk = (x - startX) * 1.2;
                    row.scrollLeft = scrollLeft - walk;
                });
            });

            // Mobile search toggle — tapping the search icon opens/closes
            // a full-width input dropped just below the header row.
            const searchWrap = document.querySelector('.up-search');
            const searchBtn = searchWrap ? searchWrap.querySelector('button') : null;
            const searchInput = searchWrap ? searchWrap.querySelector('input') : null;

            if (searchWrap && searchBtn && searchInput) {
                searchBtn.addEventListener('click', function(e) {
                    if (window.innerWidth > 768) return; // desktop search always visible
                    e.preventDefault();
                    const isOpen = searchWrap.classList.toggle('is-open');
                    if (isOpen) {
                        searchInput.focus();
                    }
                });

                document.addEventListener('click', function(e) {
                    if (window.innerWidth > 768) return;
                    if (!searchWrap.contains(e.target)) {
                        searchWrap.classList.remove('is-open');
                    }
                });
            }

            // Checkout button placeholder — wire to your real route
            const checkoutBtn = document.querySelector('.up-checkout-btn');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function() {
                    window.location.href =
                        "<?php echo e(\Illuminate\Support\Facades\Route::has('checkout') ? route('checkout') : '#'); ?>";
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Personal Projects\Upswep\upswep-fe\resources\views/frontend/index.blade.php ENDPATH**/ ?>