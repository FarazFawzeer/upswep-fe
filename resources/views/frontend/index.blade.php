@extends('frontend.layouts.front')

@section('title', 'UPSWEP - Premium Clothing')
@section('description', 'Discover premium clothing, workwear, accessories and the latest collections from UPSWEP.')

@section('content')
{{-- ============================================================
     UPSWEP HOMEPAGE
     resources/views/index.blade.php (or frontend/index.blade.php
     to match your existing route — see notes at the bottom)

     Structure: Header (partial) -> Hero -> Category circles ->
     Trending grid -> Styled-for-you strip -> Featured grid ->
     Discover brands -> Footer (partial)

     Global header/nav/footer markup now lives in shared partials
     (partials/header.blade.php, partials/footer.blade.php) so this
     file only contains what's unique to the homepage. Global CSS
     (tokens, header, nav, buttons, grid system, footer) lives once
     in layouts/front.blade.php — only home-specific CSS (hero
     video, circle-row sizing already shared, card variants used
     here) stays in this page's own @push('styles') block.
============================================================ --}}

<div class="upswep-home">

    @include('frontend.partials.header')

    {{-- ============ HERO ============ --}}
    <section class="up-hero">
        <video class="up-hero__video" autoplay muted loop playsinline>
            <source src="{{ asset('videos/hero-video-2.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="up-hero__content">
            <h1>CLOTHING LINE</h1>
            <a href="#" class="up-btn up-btn--light" style="color: #111111">SHOP NOW</a>
        </div>
    </section>

    {{-- ============ CATEGORY CIRCLES : MENS ============ --}}
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">UPSWEP MENS</h2>
            <div class="up-circle-row">
                @php
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
                @endphp
                @foreach ($mensCats as $cat)
                    <a href="#" class="up-circle">
                        <span class="up-circle__img">
                            <img src="{{ $cat['img'] }}" alt="{{ $cat['label'] }}">
                        </span>
                        <span class="up-circle__label">{{ $cat['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ TRENDING NOW (3-up) ============ --}}
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">TRENDING NOW</h2>
            <div class="up-grid up-grid--3">
                @php
                    $trending = [
                        ['label' => 'TOP PICKS', 'img' => asset('images/trending/17.jpg')],
                        ['label' => '', 'img' => asset('images/trending/14.jpg')],
                        ['label' => 'HOLIDAY SHOP', 'img' => asset('images/trending/11.jpg')],
                    ];
                @endphp
                @foreach ($trending as $card)
                    <a href="#" class="up-card up-card--tall">
                        <img src="{{ $card['img'] }}" alt="{{ $card['label'] }}">
                        <span class="up-card__caption">{{ $card['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ STYLED FOR YOU (6-up) ============ --}}
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">STYLED FOR YOU</h2>
            <div class="up-grid up-grid--6">
                @php
                    $styled = [
                        ['label' => 'OCCASIONWEAR', 'img' => asset('images/products/4.jpg')],
                        ['label' => 'SHACKET SEASON', 'img' => asset('images/products/33.jpg')],
                        ['label' => 'DENIM', 'img' => asset('images/products/44.jpg')],
                        ['label' => 'GRAPHIC SHOP', 'img' => asset('images/products/55.jpg')],
                        ['label' => 'SPORTSWEAR', 'img' => asset('images/products/66.jpg')],
                        ['label' => 'CARGOS', 'img' => asset('images/products/22.jpg')],
                    ];
                @endphp
                @foreach ($styled as $card)
                    <a href="#" class="up-card">
                        <img src="{{ $card['img'] }}" alt="{{ $card['label'] }}">
                        <span class="up-card__label">{{ $card['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ FEATURED (3-up with descriptions) ============ --}}
    <section class="up-section">
        <div class="up-container">
            <h2 class="up-section__title">FEATURED</h2>
            <div class="up-grid up-grid--3">
                @php
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
                @endphp
                @foreach ($featured as $card)
                    <div class="up-feature-card">
                        <a href="#" class="up-feature-card__img">
                            <img src="{{ $card['img'] }}" alt="{{ $card['label'] }}">
                        </a>
                        <h3>{{ $card['label'] }}</h3>
                        <p>{{ $card['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ DISCOVER BRANDS ============ --}}
    {{-- <section class="up-section">
        <div class="up-container">
            <div class="up-section__head">
                <h2 class="up-section__title up-section__title--inline">DISCOVER BRANDS</h2>
                <a href="#" class="up-btn up-btn--outline up-btn--sm">SHOP ALL BRANDS</a>
            </div>
            <div class="up-grid up-grid--3">
                @php
                    $brands = [
                        ['label' => '', 'img' => asset('images/featured/35.jpg')],
                        ['label' => '', 'img' => asset('images/featured/30.jpg')],
                        ['label' => '', 'img' => asset('images/featured/33.jpg')],
                    ];
                @endphp
                @foreach ($brands as $card)
                    <a href="#" class="up-card up-card--tall">
                        <img src="{{ $card['img'] }}" alt="{{ $card['label'] }}">
                        <span class="up-card__caption">{{ $card['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section> --}}

    @include('frontend.partials.footer')

</div>

@endsection

@push('styles')
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
@endpush