@extends('frontend.layouts.front')

@section('title', 'UPSWEP — ' . ($activeCategory?->name ?? 'All Products'))

@section('content')

<div class="upswep-home upswep-plp">

    @include('frontend.partials.header')

    {{-- ============ BREADCRUMB ============ --}}
    <div class="up-breadcrumb">
        <div class="up-container">
            <a href="{{ url('/') }}">Home</a>
            <span class="up-breadcrumb__sep">/</span>
            @if ($activeCategory)
                <span>{{ $activeCategory->name }}</span>
            @else
                <span>All Products</span>
            @endif
        </div>
    </div>

    {{-- ============ PAGE TITLE ============ --}}
    <div class="up-plp-head">
        <div class="up-container">
            <h1 class="up-plp-head__title">
                {{ $activeCategory?->name ?? 'All Products' }}
                {{-- <span class="up-plp-head__count">({{ $products->total() }})</span> --}}
            </h1>
            @if ($activeCategory)
                <p class="up-plp-head__intro">
                    Explore our {{ strtolower($activeCategory->name) }} collection — thoughtfully designed
                    pieces that move easily from everyday wear to something a little more polished.
                </p>
            @else
                <p class="up-plp-head__intro">
                    The full UPSWEP collection, in one place — shirts, jeans, knitwear, footwear and
                    the essentials you'll actually reach for. Built to last, made to be worn.
                </p>
            @endif
        </div>
    </div>

    {{-- ============ FILTER / SORT BAR ============ --}}
    <div class="up-filter-bar">
        <div class="up-container">
            <form method="GET" action="{{ url('/products') }}" class="up-filter-bar__row" id="up-filter-form">

                <div class="up-filter-bar__fields">
                    {{-- Category filter — populated from DB --}}
                    <div class="up-filter">
                        <label for="filterCategory">Category</label>
                        <select id="filterCategory" name="category" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->slug }}"
                                    {{ request('category') === $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Brand filter — hidden for now, enable when needed
                    <div class="up-filter">
                        <label for="filterBrand">Brand</label>
                        <select id="filterBrand" name="brand" onchange="this.form.submit()">
                            <option value="">All Brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}"
                                    {{ request('brand') === $brand->slug ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    --}}

                    {{-- Sort --}}
                    <div class="up-filter">
                        <label for="sortBy">Sort by</label>
                        <select id="sortBy" name="sort" onchange="this.form.submit()">
                            <option value="newest"     {{ request('sort', 'newest') === 'newest'     ? 'selected' : '' }}>Newest First</option>
                            <option value="price-low"  {{ request('sort') === 'price-low'            ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price-high" {{ request('sort') === 'price-high'           ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name-az"    {{ request('sort') === 'name-az'              ? 'selected' : '' }}>Name: A to Z</option>
                        </select>
                    </div>

                    {{-- Clear — only shown when a filter is active --}}
                    @if (request('category') || request('sort'))
                        <a href="{{ url('/products') }}" class="up-btn up-btn--outline up-btn--sm up-filter-bar__clear">
                            CLEAR
                        </a>
                    @endif
                </div>

                {{-- Count pushed to the right --}}
                <p class="up-filter-bar__count mb-0">
                    <span class="up-filter-bar__count-number">{{ $products->total() }}</span>
                    product{{ $products->total() !== 1 ? 's' : '' }}
                    @if ($activeCategory) in <strong>{{ $activeCategory->name }}</strong>@endif
                </p>

            </form>
        </div>
    </div>

    {{-- ============ PRODUCT GRID ============ --}}
    <section class="up-section up-plp-section">
        <div class="up-container">

            @if ($products->isEmpty())
                <div class="up-plp-empty">
                    <p>No products found matching your filters.</p>
                    <a href="{{ url('/products') }}" class="up-btn up-btn--outline up-btn--sm" style="margin-top:12px;">
                        View All Products
                    </a>
                </div>
            @else
                <div class="up-product-grid">
                    @foreach ($products as $product)
                        <a href="{{ url('/product/' . $product->slug) }}" class="up-product-card">
                            <div class="up-product-card__img">
                                {{-- img_url() checks WebP first, falls back to original --}}
                                {{-- reads directly from storage/app/public — no symlink --}}
                                <img src="{{ img_url($product->main_image) }}"
                                    alt="{{ $product->name }}"
                                    loading="lazy">
                                <button type="button" class="up-product-card__wish" aria-label="Add to wishlist"
                                    onclick="event.preventDefault()">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none"
                                        stroke="currentColor" stroke-width="1.6">
                                        <path d="M12 21s-7.5-4.6-10-9.3C.6 8.2 2.4 4.5 6 4c2.2-.3 4.2 1 6 3.1C13.8 5 15.8 3.7 18 4c3.6.5 5.4 4.2 4 7.7C19.5 16.4 12 21 12 21z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="up-product-card__body">
                                <span class="up-product-card__brand">
                                    {{ $product->brand?->name ?? $product->category?->name ?? '' }}
                                </span>
                                <span class="up-product-card__name">{{ $product->name }}</span>
                                <span class="up-product-card__price">
                                    @if ($product->price)
                                        LKR {{ number_format($product->price, 2) }}
                                    @else
                                        Contact for price
                                    @endif
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- ============ PAGINATION ============ --}}
            @if ($products->hasPages())
                <div class="up-pagination">
                    {{ $products->links('vendor.pagination.upswep') }}
                </div>
            @endif

        </div>
    </section>

    @include('frontend.partials.footer')

</div>

@endsection

@push('styles')
<style>
    /* =========================================================
       PRODUCTS PAGE — PAGE-ONLY STYLES
    ========================================================= */
    .up-plp-section { padding-top: 28px; }

    .up-plp-head__intro {
        max-width: 640px;
    }

    .up-plp-head{
        margin-top: 15px;
    }

    /* ---- Filter bar ---- */
    .up-filter-bar {
        background: var(--up-bg);
        border: 1px solid var(--up-line);
        border-radius: 10px;
        padding: 20px 24px;
        margin: 24px 0 8px;
    }
    .up-filter-bar__row {
        display: flex !important;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }
    .up-filter-bar__fields {
        display: flex;
        align-items: flex-end;
        gap: 20px;
        flex-wrap: wrap;
    }
    .up-filter {
        display: flex;
        flex-direction: column;
        gap: 7px;
        width: 190px;
        flex: 0 0 auto;
    }
    .up-filter label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--up-muted);
    }
    .up-filter select {
        appearance: none;
        -webkit-appearance: none;
        background: #fff url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%231a1a1a' stroke-width='2'%3e%3cpath d='M6 9l6 6 6-6'/%3e%3c/svg%3e") no-repeat right 12px center;
        background-size: 14px;
        padding: 9px 34px 9px 12px;
        font-size: 12.5px;
        font-weight: 500;
        border: 1px solid #d4d1c8;
        border-radius: 6px;
        color: #1a1a1a;
        cursor: pointer;
        height: 38px;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .up-filter select:hover {
        border-color: #b8b4ac;
    }
    .up-filter select:focus {
        outline: none;
        border-color: var(--up-black);
        box-shadow: 0 0 0 3px rgba(0,0,0,.06);
    }
    .up-filter-bar__clear {
        align-self: center;
        padding: 0;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .04em;
        height: 38px;
        display: flex;
        align-items: center;
        flex: 0 0 auto;
        border: none;
        background: none;
        color: var(--up-muted);
        text-decoration: underline;
    }
    .up-filter-bar__clear:hover {
        color: var(--up-black);
    }
    .up-filter-bar__count {
        font-size: 12.5px;
        color: var(--up-muted);
        white-space: nowrap;
        padding-bottom: 9px;
    }
    .up-filter-bar__count-number {
        font-weight: 700;
        color: #1a1a1a;
    }

    .up-product-grid {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 22px 16px;
        margin-top: 8px;
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
        position: absolute; top: 8px; right: 8px;
        width: 28px; height: 28px; border-radius: 50%;
        background: rgba(255,255,255,.9); border: none;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #1a1a1a;
    }
    .up-product-card__wish:hover { background: #fff; }

    .up-product-card__body { display: flex; flex-direction: column; gap: 3px; }
    .up-product-card__brand {
        font-size: 9.5px; font-weight: 700; letter-spacing: .05em;
        text-transform: uppercase; color: var(--up-muted);
    }
    .up-product-card__name {
        font-size: 12px; font-weight: 500; color: #1a1a1a;
        line-height: 1.4;
        display: -webkit-box; -webkit-line-clamp: 2;
        -webkit-box-orient: vertical; overflow: hidden;
    }
    .up-product-card__price { font-size: 13px; font-weight: 700; color: #1a1a1a; margin-top: 2px; }

    .up-plp-empty {
        text-align: center; padding: 60px 0;
        color: var(--up-muted); font-size: 13px;
    }

    /* ---- Pagination — matches Laravel paginator output ---- */
    .up-pagination { display: flex; justify-content: center; margin-top: 36px; }
    .up-pagination nav { display: flex; justify-content: center; width: 100%; }
    .up-pagination ul {
        display: flex; align-items: center; gap: 6px;
        list-style: none; margin: 0; padding: 0;
    }
    .up-pagination ul li span,
    .up-pagination ul li a {
        min-width: 32px; height: 32px; display: flex;
        align-items: center; justify-content: center;
        font-size: 12px; font-weight: 600;
        border: 1px solid var(--up-line); border-radius: 2px;
        color: #1a1a1a; text-decoration: none;
    }
    .up-pagination ul li span:hover,
    .up-pagination ul li a:hover { background: var(--up-bg); }
    .up-pagination ul li.active span {
        background: var(--up-black); color: #fff; border-color: var(--up-black);
    }
    .up-pagination ul li[aria-disabled="true"] span { color: #c9c5b8; pointer-events: none; }

    /* ---- Responsive ---- */
    @media (max-width: 1100px) {
        .up-product-grid { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; }
    }
    @media (max-width: 768px) {
        .up-plp-head__title { font-size: 19px; }
        .up-filter-bar { padding: 16px 16px; }
        .up-filter-bar__row { gap: 16px; }
        .up-filter-bar__fields { gap: 10px; width: 100%; }
        .up-filter { min-width: 0; flex: 1 1 calc(50% - 5px); }
        .up-filter-bar__clear { flex: 1 1 100%; justify-content: center; }
        .up-filter-bar__count {
            width: 100%;
            padding-bottom: 0;
            padding-top: 12px;
            border-top: 1px solid var(--up-line);
        }
        .up-product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 16px 10px;
        }
        .up-product-card__name { font-size: 11px; }
        .up-product-card__price { font-size: 12px; }
    }
</style>


@endpush