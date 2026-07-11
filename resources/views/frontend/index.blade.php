@extends('frontend.layouts.front')

@section('title', 'UPSWEP - Premium Clothing')
@section('description', 'Discover premium clothing, workwear, accessories and the latest collections from UPSWEP.')

@section('content')

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
            <a href="{{ url('/products') }}" class="up-btn up-btn--light" style="color: #111111">SHOP NOW</a>
        </div>
    </section>

    {{-- ============ CATEGORY CIRCLES ============ --}}
    @if ($categories->isNotEmpty())
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">UPSWEP MENS</h2>
                <div class="up-circle-row">
                    @foreach ($categories as $cat)
                        <a href="{{ url('/products?category=' . $cat->slug) }}" class="up-circle">
                            <span class="up-circle__img">
                                @if ($cat->image)
                                    {{-- img_url() checks WebP first, falls back to original --}}
                                    {{-- reads directly from storage/app/public, no symlink needed --}}
                                    <img src="{{ img_url($cat->image) }}" alt="{{ $cat->name }}">
                                @else
                                    <span class="up-circle__placeholder">
                                        {{ strtoupper(substr($cat->name, 0, 1)) }}
                                    </span>
                                @endif
                            </span>
                            <span class="up-circle__label">{{ strtoupper($cat->name) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ TRENDING NOW (3-up) ============ --}}
    @if ($trending->isNotEmpty())
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">TRENDING NOW</h2>
                <div class="up-grid up-grid--3">
                    @foreach ($trending as $product)
                        <a href="{{ url('/product/' . $product->slug) }}" class="up-card up-card--tall">
                            @if ($product->main_image)
                                <img src="{{ img_url($product->main_image) }}" alt="{{ $product->name }}">
                            @else
                                <div class="up-card__no-image">
                                    <span>{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="up-card__caption">{{ strtoupper($product->name) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ STYLED FOR YOU (6-up) ============ --}}
    @if ($styled->isNotEmpty())
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">STYLED FOR YOU</h2>
                <div class="up-grid up-grid--6">
                    @foreach ($styled as $product)
                        <a href="{{ url('/product/' . $product->slug) }}" class="up-card">
                            @if ($product->main_image)
                                <img src="{{ img_url($product->main_image) }}" alt="{{ $product->name }}">
                            @else
                                <div class="up-card__no-image">
                                    <span>{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="up-card__label">{{ strtoupper($product->name) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ FEATURED (3-up with descriptions) ============ --}}
    @if ($featured->isNotEmpty())
        <section class="up-section">
            <div class="up-container">
                <h2 class="up-section__title">FEATURED</h2>
                <div class="up-grid up-grid--3">
                    @foreach ($featured as $product)
                        <div class="up-feature-card">
                            <a href="{{ url('/product/' . $product->slug) }}" class="up-feature-card__img">
                                @if ($product->main_image)
                                    <img src="{{ img_url($product->main_image) }}" alt="{{ $product->name }}">
                                @else
                                    <div class="up-card__no-image up-card__no-image--tall">
                                        <span>{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </a>
                            <h3>{{ strtoupper($product->name) }}</h3>
                            <p>{{ $product->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('frontend.partials.footer')

</div>

@endsection

@push('styles')
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
@endpush