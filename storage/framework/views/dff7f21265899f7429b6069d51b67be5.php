<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


<title><?php echo $__env->yieldContent('title', 'UPSWEP — Premium Clothing'); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('description', 'Discover premium clothing, workwear, accessories and the latest collections from UPSWEP.'); ?>">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<link rel="canonical" href="<?php echo e(url()->current()); ?>">


<meta property="og:type"         content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
<meta property="og:locale"       content="en_LK">
<meta property="og:site_name"    content="UPSWEP">
<meta property="og:title"        content="<?php echo $__env->yieldContent('title', 'UPSWEP — Premium Clothing'); ?>">
<meta property="og:description"  content="<?php echo $__env->yieldContent('description', 'Discover premium clothing, workwear, accessories and the latest collections from UPSWEP.'); ?>">
<meta property="og:url"          content="<?php echo e(url()->current()); ?>">
<meta property="og:image"        content="<?php echo $__env->yieldContent('og_image', asset('images/share-image.png')); ?>">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt"    content="<?php echo $__env->yieldContent('title', 'UPSWEP — Premium Clothing'); ?>">


<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:site"        content="@upswep">
<meta name="twitter:title"       content="<?php echo $__env->yieldContent('title', 'UPSWEP — Premium Clothing'); ?>">
<meta name="twitter:description" content="<?php echo $__env->yieldContent('description', 'Discover premium clothing, workwear, accessories and the latest collections from UPSWEP.'); ?>">
<meta name="twitter:image"       content="<?php echo $__env->yieldContent('og_image', asset('images/share-image.png')); ?>">
<meta name="twitter:image:alt"   content="<?php echo $__env->yieldContent('title', 'UPSWEP — Premium Clothing'); ?>">


<link rel="icon"             type="image/png" sizes="32x32"  href="<?php echo e(asset('images/favicon-32.png')); ?>">
<link rel="icon"             type="image/png" sizes="16x16"  href="<?php echo e(asset('images/favicon-16.png')); ?>">
<link rel="apple-touch-icon"                  sizes="180x180" href="<?php echo e(asset('images/apple-touch-icon.png')); ?>">
<meta name="theme-color" content="#111111">


<?php if (! empty(trim($__env->yieldContent('schema')))): ?>
    <?php echo $__env->yieldContent('schema'); ?>
<?php else: ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ClothingStore",
    "name": "UPSWEP",
    "url": "<?php echo e(url('/')); ?>",
    "logo": "<?php echo e(asset('images/upswep.png')); ?>",
    "image": "<?php echo e(asset('images/share-image.png')); ?>",
    "description": "Premium clothing, workwear and accessories from UPSWEP.",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "57/A, Jumma Mawatha",
        "addressLocality": "Negombo",
        "addressCountry": "LK"
    },
    "telephone": "+94772370465",
    "email": "safwanasmi21@gmail.com",
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
            "opens": "09:00",
            "closes": "21:30"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "Saturday",
            "opens": "09:00",
            "closes": "21:30"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "Sunday",
            "opens": "10:00",
            "closes": "21:00"
        }
    ],
    "sameAs": [
        "https://www.facebook.com/upswep",
        "https://www.instagram.com/upswep",
        "https://www.tiktok.com/@upswep"
    ]
}
</script>
<?php endif; ?>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    
    <style>
        /* =========================================================
           DESIGN TOKENS + BASE RESET — scoped under .upswep-home
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
            border: none;
            cursor: pointer;
            color: var(--up-muted);
        }

        .up-logo {
            font-family: next-display-700, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
            font-weight: 500;
            font-size: 28px;
            letter-spacing: 1px;
            text-transform: uppercase;
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

        /* ---- Buttons (used across all pages: hero CTA, filter bar, etc.) ---- */
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

        /* ---- Section base (used on home, products, and future pages) ---- */
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

        /* ---- Circle row (category circles — used on home, reusable elsewhere) ---- */
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

        /* ---- Grids (generic N-up grid system, used on home and products) ---- */
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

        /* ---- Feature cards (used on home's FEATURED section) ---- */
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

        /* ---- Footer links (mega footer, used wherever included) ---- */
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

        /* ---- Footer bottom (shared footer, included on every page) ---- */
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
               search+wishlist (left) | logo (center) | account+bag+checkout (right) */
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

        /* Hide checkout/wishlist on very small screens if a page opts in
           (only applied where a page adds the .up-hide-on-mobile hook —
           kept here as a reusable utility, not forced globally). */
        @media (max-width: 767px) {
            .up-social-like,
            .up-checkout-btn.up-hide-on-mobile {
                display: none !important;
            }
        }
    </style>

    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <?php echo $__env->yieldContent('content'); ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Drag-to-scroll for circle rows (mouse + touch already native via overflow-x)
            document.querySelectorAll('.up-circle-row').forEach(function (row) {
                let isDown = false, startX, scrollLeft;

                row.addEventListener('mousedown', function (e) {
                    isDown = true;
                    row.classList.add('is-dragging');
                    startX = e.pageX - row.offsetLeft;
                    scrollLeft = row.scrollLeft;
                });
                row.addEventListener('mouseleave', function () { isDown = false; });
                row.addEventListener('mouseup', function () { isDown = false; });
                row.addEventListener('mousemove', function (e) {
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
                searchBtn.addEventListener('click', function (e) {
                    if (window.innerWidth > 768) return; // desktop search always visible
                    e.preventDefault();
                    const isOpen = searchWrap.classList.toggle('is-open');
                    if (isOpen) {
                        searchInput.focus();
                    }
                });

                document.addEventListener('click', function (e) {
                    if (window.innerWidth > 768) return;
                    if (!searchWrap.contains(e.target)) {
                        searchWrap.classList.remove('is-open');
                    }
                });
            }

            // Checkout button placeholder — wire to your real route
            const checkoutBtn = document.querySelector('.up-checkout-btn');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function () {
                    window.location.href =
                        "<?php echo e(\Illuminate\Support\Facades\Route::has('checkout') ? route('checkout') : '#'); ?>";
                });
            }
        });
    </script>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH F:\Personal Projects\Upswep\upswep-fe\resources\views/frontend/layouts/front.blade.php ENDPATH**/ ?>