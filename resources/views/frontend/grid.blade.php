@extends('frontend.layouts.front')

@section('title', 'Products - UPSWEP')
@section('description', 'Browse our latest collection of shirts, hoodies, jeans, footwear and accessories.')

@section('content')
{{-- ============================================================
     UPSWEP PRODUCTS LISTING PAGE (PLP)
     resources/views/frontend/grid.blade.php

     Structure: Header (partial) -> Breadcrumb -> Page title+count
     -> Filter/Sort bar -> Product grid (4-up desktop / 2-up mobile)
     -> Pagination -> Footer (partial)

     Global header/nav/footer markup now lives in shared partials
     (partials/header.blade.php, partials/footer.blade.php) so this
     file only contains what's unique to the products page. Global
     CSS (tokens, header, nav, buttons, grid base, footer) lives
     once in layouts/front.blade.php — only PLP-specific CSS
     (breadcrumb, page head, filter bar, product card, pagination)
     stays in this page's own @push('styles') block.

     Placeholder product data for now — swap $products for a real
     Eloquent paginate() call once the Product model is wired up.
============================================================ --}}

<div class="upswep-home upswep-plp">

    @php
        // ----------------------------------------------------------
        // PLACEHOLDER DATA — defined here, at the top of the view,
        // so it exists before the filter bar's product count and
        // the grid below both try to read it. Replace with a real
        // Eloquent query in your controller, e.g.:
        //
        // $products = Product::with(['category', 'brand', 'images'])
        //     ->where('is_active', 1)
        //     ->latest()
        //     ->paginate(20);
        //
        // Once the controller passes a real $products variable to
        // this view, this whole @php block is simply skipped (the
        // ?? fallback only fires when $products isn't already set).
        // ----------------------------------------------------------
        $products = $products ?? [
            ['name' => 'White Slim Fit Easy Care Single Cuff Smart Shirt', 'category' => 'Shirts', 'brand' => 'BrandOne', 'price' => 22.00, 'img' => asset('images/products/1.jpg')],
            ['name' => 'White Button Down Collar Cotton Linen Blend Short Sleeve Shirt', 'category' => 'Shirts', 'brand' => 'BrandTwo', 'price' => 28.00, 'img' => asset('images/products/2.jpg')],
            ['name' => 'Light Blue Slim Fit Easy Care Single Cuff Shirt', 'category' => 'Shirts', 'brand' => 'BrandOne', 'price' => 22.00, 'img' => asset('images/products/3.jpg')],
            ['name' => 'Ecru Sage Green Regular Fit Premium Short Sleeve Shirt', 'category' => 'Shirts', 'brand' => 'BrandThree', 'price' => 32.00, 'img' => asset('images/products/4.jpg')],
            ['name' => 'White Easy Care Cotton Single Cuff Smart Shirt', 'category' => 'Shirts', 'brand' => 'BrandOne', 'price' => 24.00, 'img' => asset('images/products/1.jpg')],
            ['name' => 'Blue Button Collar Cotton Linen Blend Short Sleeve Shirt', 'category' => 'Shirts', 'brand' => 'BrandTwo', 'price' => 28.00, 'img' => asset('images/products/2.jpg')],
            ['name' => 'Multi Colour Linen Blend Short Sleeve Shirt', 'category' => 'Shirts', 'brand' => 'BrandThree', 'price' => 30.00, 'img' => asset('images/products/3.jpg')],
            ['name' => 'Threadbare White Short Sleeve Linen Blend Shirt', 'category' => 'Shirts', 'brand' => 'BrandTwo', 'price' => 26.00, 'img' => asset('images/products/4.jpg')],
            ['name' => 'Neutral Button Down Collar Cotton Linen Blend Shirt', 'category' => 'Shirts', 'brand' => 'BrandOne', 'price' => 22.00, 'img' => asset('images/products/1.jpg')],
            ['name' => 'White Regular Fit Short Sleeve Oxford Shirt', 'category' => 'Shirts', 'brand' => 'BrandTwo', 'price' => 22.00, 'img' => asset('images/products/2.jpg')],
            ['name' => 'Light Blue Regular Fit Easy Care Single Cuff Shirt', 'category' => 'Shirts', 'brand' => 'BrandThree', 'price' => 28.00, 'img' => asset('images/products/3.jpg')],
            ['name' => 'Pink Button Down Collar Cotton Linen Blend Short Sleeve Shirt', 'category' => 'Shirts', 'brand' => 'BrandOne', 'price' => 28.00, 'img' => asset('images/products/4.jpg')],
        ];
    @endphp

    @include('frontend.partials.header')

    {{-- ============ BREADCRUMB ============ --}}
    <div class="up-breadcrumb">
        <div class="up-container">
            <a href="{{ url('/') }}">Home</a>
            <span class="up-breadcrumb__sep">/</span>
            <span>Shirts</span>
        </div>
    </div>

    {{-- ============ PAGE TITLE + INTRO ============ --}}
    <div class="up-plp-head">
        <div class="up-container">
            <h1 class="up-plp-head__title">Men's Shirts <span class="up-plp-head__count">(64)</span></h1>
            <p class="up-plp-head__intro">
                Shirts for every occasion, from casual weekends to smart office days. Choose from classic Oxfords,
                relaxed linen, and easy-care fits — designed to look sharp and feel comfortable all day.
            </p>
        </div>
    </div>

    {{-- ============ FILTER / SORT BAR ============ --}}
    <div class="up-filter-bar">
        <div class="up-container">
            <form class="up-filter-bar__row" id="up-filter-form">
                <div class="up-filter">
                    <label for="filterCategory">Category</label>
                    <select id="filterCategory" name="category">
                        <option value="">All Categories</option>
                        <option value="shirts">Shirts</option>
                        <option value="t-shirts">T-Shirts</option>
                        <option value="jeans">Jeans</option>
                        <option value="hoodies">Hoodies</option>
                        <option value="trousers">Trousers</option>
                        <option value="footwear">Footwear</option>
                        <option value="knitwear">Knitwear</option>
                        <option value="accessories">Accessories</option>
                    </select>
                </div>

                <div class="up-filter">
                    <label for="filterBrand">Brand</label>
                    <select id="filterBrand" name="brand">
                        <option value="">All Brands</option>
                        <option value="brandone">BrandOne</option>
                        <option value="brandtwo">BrandTwo</option>
                        <option value="brandthree">BrandThree</option>
                    </select>
                </div>

                <div class="up-filter up-filter--sort">
                    <label for="sortBy">Sort by</label>
                    <select id="sortBy" name="sort">
                        <option value="newest">Newest First</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="name-az">Name: A to Z</option>
                    </select>
                </div>

                <button type="button" id="up-filter-clear" class="up-btn up-btn--outline up-btn--sm up-filter-bar__clear">
                    CLEAR
                </button>
            </form>

            <p class="up-filter-bar__count" id="up-result-count">Showing {{ count($products) }} products</p>
        </div>
    </div>

    {{-- ============ PRODUCT GRID ============ --}}
    <section class="up-section up-plp-section">
        <div class="up-container">

            <div class="up-product-grid">
                @forelse ($products as $product)
                    <a href="{{ url('/product') }}" class="up-product-card">
                        <div class="up-product-card__img">
                            <img src="{{ is_array($product) ? $product['img'] : $product->images->first()?->image_path }}"
                                alt="{{ is_array($product) ? $product['name'] : $product->name }}">
                            <button type="button" class="up-product-card__wish" aria-label="Add to wishlist">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 21s-7.5-4.6-10-9.3C.6 8.2 2.4 4.5 6 4c2.2-.3 4.2 1 6 3.1C13.8 5 15.8 3.7 18 4c3.6.5 5.4 4.2 4 7.7C19.5 16.4 12 21 12 21z" />
                                </svg>
                            </button>
                        </div>
                        <div class="up-product-card__body">
                            <span class="up-product-card__brand">{{ is_array($product) ? $product['brand'] : $product->brand?->name }}</span>
                            <span class="up-product-card__name">{{ is_array($product) ? $product['name'] : $product->name }}</span>
                            <span class="up-product-card__price">£{{ number_format(is_array($product) ? $product['price'] : $product->price, 2) }}</span>
                        </div>
                    </a>
                @empty
                    <p class="up-plp-empty">No products found. Check back soon.</p>
                @endforelse
            </div>

            {{-- ============ PAGINATION ============ --}}
            <div class="up-pagination">
                @if (is_object($products) && method_exists($products, 'links'))
                    {{ $products->links() }}
                @else
                    {{-- Placeholder pagination markup — replace with $products->links() once paginated --}}
                    <nav class="up-pagination__nav" aria-label="Pagination">
                        <a href="#" class="up-pagination__btn is-disabled" aria-disabled="true">&laquo;</a>
                        <a href="#" class="up-pagination__btn is-active">1</a>
                        <a href="#" class="up-pagination__btn">2</a>
                        <a href="#" class="up-pagination__btn">3</a>
                        <span class="up-pagination__dots">…</span>
                        <a href="#" class="up-pagination__btn">6</a>
                        <a href="#" class="up-pagination__btn">&raquo;</a>
                    </nav>
                @endif
            </div>

        </div>
    </section>

    @include('frontend.partials.footer')

</div>

@endsection

@push('styles')
<style>
    /* =========================================================
       PRODUCTS PAGE-ONLY STYLES
       Everything global (tokens, header, nav, buttons, grid base,
       footer) already lives in layouts/front.blade.php. Only PLP-
       specific rules live here: breadcrumb, page head, filter bar,
       product grid/card, pagination.
    ========================================================= */

    /* ---- Breadcrumb ---- */
    .up-breadcrumb {
        background: #fff;
        border-bottom: 1px solid var(--up-line);
        padding: 10px 0;
        font-size: 11.5px;
        color: var(--up-muted);
    }
    .up-breadcrumb a { color: var(--up-muted); }
    .up-breadcrumb a:hover { color: var(--up-black); text-decoration: underline; }
    .up-breadcrumb__sep { margin: 0 6px; color: #c9c5b8; }

    /* ---- Page head ---- */
    .up-plp-head {
        background: #fff;
        padding: 22px 0 16px;
    }
    .up-plp-head__title {
        font-size: 24px;
        font-weight: 700;
        letter-spacing: .01em;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    .up-plp-head__count {
        font-size: 14px;
        font-weight: 500;
        color: var(--up-muted);
    }
    .up-plp-head__intro {
        font-size: 12.5px;
        color: var(--up-muted);
        max-width: 760px;
        line-height: 1.6;
    }

    /* ---- Filter / sort bar ---- */
    .up-filter-bar {
        background: var(--up-bg);
        border-top: 1px solid var(--up-line);
        border-bottom: 1px solid var(--up-line);
        padding: 14px 0;
    }
    .up-filter-bar__row {
        display: flex !important;
        align-items: flex-end;
        gap: 16px;
        flex-wrap: wrap;
    }
    .up-filter {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 160px;
    }
    .up-filter label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: var(--up-muted);
    }
    .up-filter select {
        padding: 8px 10px;
        font-size: 12.5px;
        border: 1px solid #d4d1c8;
        border-radius: 2px;
        background: #fff;
        color: #1a1a1a;
        cursor: pointer;
    }
    .up-filter--sort { margin-left: auto; }
    .up-filter-bar__clear {
        align-self: flex-end;
        padding: 8px 18px;
        font-size: 10.5px;
    }
    .up-filter-bar__count {
        margin-top: 10px;
        font-size: 11.5px;
        color: var(--up-muted);
    }

    /* ---- Product grid ---- */
    .up-plp-section { padding-top: 28px; }
    .up-product-grid {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 22px 16px;
    }

    .up-product-card { display: block; }
    .up-product-card__img {
        position: relative;
        aspect-ratio: 3/4;
        overflow: hidden;
        background: #f0eee8;
        margin-bottom: 10px;
    }
    .up-product-card__img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .35s ease;
    }
    .up-product-card:hover .up-product-card__img img { transform: scale(1.04); }

    .up-product-card__wish {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .9);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #1a1a1a;
    }
    .up-product-card__wish:hover { background: #fff; }

    .up-product-card__body {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .up-product-card__brand {
        font-size: 9.5px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
        color: var(--up-muted);
    }
    .up-product-card__name {
        font-size: 12px;
        font-weight: 500;
        color: #1a1a1a;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .up-product-card__price {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
        margin-top: 2px;
    }

    .up-plp-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 0;
        color: var(--up-muted);
        font-size: 13px;
    }

    /* ---- Pagination ---- */
    .up-pagination {
        display: flex;
        justify-content: center;
        margin-top: 36px;
    }
    .up-pagination__nav {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .up-pagination__btn {
        min-width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid var(--up-line);
        border-radius: 2px;
        color: #1a1a1a;
    }
    .up-pagination__btn:hover { background: var(--up-bg); }
    .up-pagination__btn.is-active { background: var(--up-black); color: #fff; border-color: var(--up-black); }
    .up-pagination__btn.is-disabled { color: #c9c5b8; pointer-events: none; }
    .up-pagination__dots { padding: 0 4px; color: var(--up-muted); font-size: 12px; }

    /* Laravel's default ->links() pagination markup gets the same look */
    .up-pagination nav { display: flex; justify-content: center; width: 100%; }
    .up-pagination ul {
        display: flex;
        align-items: center;
        gap: 6px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .up-pagination ul li span,
    .up-pagination ul li a {
        min-width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid var(--up-line);
        border-radius: 2px;
        color: #1a1a1a;
        text-decoration: none;
    }
    .up-pagination ul li.active span { background: var(--up-black); color: #fff; border-color: var(--up-black); }

    /* ---- Responsive ---- */
    @media (max-width: 1100px) {
        .up-product-grid { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; }
    }

    @media (max-width: 768px) {
        .up-plp-head__title { font-size: 19px; }
        .up-plp-head__intro { font-size: 11.5px; }

        .up-filter-bar__row { gap: 10px; }
        .up-filter { min-width: 0; flex: 1 1 calc(50% - 5px); }
        .up-filter--sort { margin-left: 0; flex: 1 1 100%; }
        .up-filter-bar__clear { flex: 1 1 100%; align-self: stretch; text-align: center; }

        .up-product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 16px 10px;
        }

        .up-product-card__name { font-size: 11px; }
        .up-product-card__price { font-size: 12px; }
    }
</style>
@endpush

@push('scripts')
<script>
    // =========================================================
    // PRODUCTS PAGE-ONLY JS
    // Drag-scroll, mobile search toggle, and checkout button are
    // already global (see layouts/front.blade.php). Only the
    // filter/sort form behavior is specific to this page.
    // =========================================================
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('up-filter-form');
        const clearBtn = document.getElementById('up-filter-clear');

        // Placeholder: once products come from the DB, swap this for a
        // real form submit (GET request with category/brand/sort query
        // params) so the controller can filter/sort server-side.
        if (form) {
            form.addEventListener('change', function () {
                // TODO: replace with form.submit() once the controller
                // reads ?category=&brand=&sort= from the request.
                console.log('Filter changed — wire this to a real query once products are in the DB.');
            });
        }

        if (clearBtn && form) {
            clearBtn.addEventListener('click', function () {
                form.reset();
            });
        }
    });
</script>
@endpush