@extends('frontend.layouts.front')

@section('title', 'UPSWEP — ' . $product->name)
@section('description', $product->description ?? 'View product details and enquire at UPSWEP.')

@section('content')

{{-- ============================================================
     UPSWEP SINGLE PRODUCT PAGE (PDP)
     resources/views/frontend/product.blade.php

     Data comes from: Frontend\ProductController@show
     Route: GET /product/{slug}

     $product        → Product model (with category, brand)
     $images         → array of full URLs via Product::getAllImagesAttribute()
     $primaryImage   → first image URL (main_image)
     $relatedProducts→ up to 4 products from same category
============================================================ --}}

<div class="upswep-home upswep-pdp">

    @include('frontend.partials.header')

    {{-- ============ BREADCRUMB ============ --}}
    <div class="up-breadcrumb">
        <div class="up-container">
            <a href="{{ url('/') }}">Home</a>
            <span class="up-breadcrumb__sep">/</span>
            <a href="{{ url('/products?category=' . $product->category?->slug) }}">
                {{ $product->category?->name ?? 'Products' }}
            </a>
            <span class="up-breadcrumb__sep">/</span>
            <span>{{ $product->name }}</span>
        </div>
    </div>

    {{-- ============ PRODUCT MAIN: GALLERY + INFO ============ --}}
    <section class="up-section up-pdp-section">
        <div class="up-container">
            <div class="up-pdp">

                {{-- ---- Gallery: thumbnails + big image ---- --}}
                <div class="up-pdp__gallery">

                    {{-- Thumbnail strip (left on desktop, bottom on mobile) --}}
                    @if (count($images) > 1)
                        <div class="up-pdp__thumbs" id="up-pdp-thumbs">
                            @foreach ($images as $i => $imgUrl)
                                <button type="button"
                                    class="up-pdp__thumb {{ $i === 0 ? 'is-active' : '' }}"
                                    data-img="{{ $imgUrl }}"
                                    aria-label="View image {{ $i + 1 }}">
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }} image {{ $i + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    @endif

                    {{-- Main image --}}
                    <div class="up-pdp__main-img">
                        @if ($primaryImage)
                            <img src="{{ $primaryImage }}"
                                alt="{{ $product->name }}"
                                id="up-pdp-main-img">
                        @else
                            <div class="up-pdp__no-image">
                                <span>{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                            </div>
                        @endif

                        <button type="button" class="up-pdp__wish" aria-label="Add to wishlist">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none"
                                stroke="currentColor" stroke-width="1.6">
                                <path d="M12 21s-7.5-4.6-10-9.3C.6 8.2 2.4 4.5 6 4c2.2-.3 4.2 1 6 3.1C13.8 5 15.8 3.7 18 4c3.6.5 5.4 4.2 4 7.7C19.5 16.4 12 21 12 21z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- ---- Product info + enquiry form ---- --}}
                <div class="up-pdp__info">

                    {{-- Brand + category labels --}}
                    <div class="up-pdp__meta">
                        @if ($product->brand)
                            <span class="up-pdp__brand">{{ $product->brand->name }}</span>
                        @endif
                        @if ($product->category)
                            <a href="{{ url('/products?category=' . $product->category->slug) }}"
                                class="up-pdp__category">
                                {{ $product->category->name }}
                            </a>
                        @endif
                    </div>

                    <h1 class="up-pdp__name">{{ $product->name }}</h1>

                    {{-- Price + SKU --}}
                    <div class="up-pdp__price-row">
                        <span class="up-pdp__price">
                            @if ($product->price)
                                £{{ number_format($product->price, 2) }}
                            @else
                                Contact for price
                            @endif
                        </span>
                        @if ($product->sku)
                            <span class="up-pdp__sku">SKU: {{ $product->sku }}</span>
                        @endif
                    </div>

                    {{-- Description --}}
                    @if ($product->description)
                        <p class="up-pdp__desc">{{ $product->description }}</p>
                    @endif

                    {{-- Details bullet list --}}
                    @if ($product->details && count($product->details))
                        <ul class="up-pdp__details">
                            @foreach ($product->details as $line)
                                <li>{{ $line }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Enquiry form --}}
                    <div class="up-pdp__enquiry">
                        <h2 class="up-pdp__enquiry-title">Interested in this item?</h2>
                        <p class="up-pdp__enquiry-sub">
                            Send us your details and we'll get back to you about availability and pricing.
                        </p>

                        {{-- Success message --}}
                        @if (session('enquiry_success'))
                            <div class="up-pdp__alert up-pdp__alert--success">
                                {{ session('enquiry_success') }}
                            </div>
                        @endif

                        @if (session('enquiry_error'))
                            <div class="up-pdp__alert up-pdp__alert--error">
                                {{ session('enquiry_error') }}
                            </div>
                        @endif

                        <form method="POST"
                            action="{{ route('enquiries.store') }}"
                            class="up-pdp__form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="up-pdp__form-row">
                                <label for="enq_name">Name <span class="up-pdp__req">*</span></label>
                                <input type="text" id="enq_name" name="name"
                                    value="{{ old('name') }}"
                                    required placeholder="Your full name"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @error('name')
                                    <span class="up-pdp__field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="up-pdp__form-row up-pdp__form-row--split">
                                <div>
                                    <label for="enq_phone">Phone <span class="up-pdp__req">*</span></label>
                                    <input type="tel" id="enq_phone" name="phone"
                                        value="{{ old('phone') }}"
                                        required placeholder="07X XXX XXXX"
                                        class="{{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                    @error('phone')
                                        <span class="up-pdp__field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="enq_email">
                                        Email <span class="up-pdp__optional">(optional)</span>
                                    </label>
                                    <input type="email" id="enq_email" name="email"
                                        value="{{ old('email') }}"
                                        placeholder="you@example.com"
                                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                                    @error('email')
                                        <span class="up-pdp__field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="up-pdp__form-row">
                                <label for="enq_message">
                                    Message <span class="up-pdp__optional">(optional)</span>
                                </label>
                                <textarea id="enq_message" name="message" rows="3"
                                    placeholder="Any questions about size, colour, or availability...">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="up-btn up-pdp__submit">
                                SEND ENQUIRY
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.footer')

</div>

@endsection

@push('styles')
<style>
    /* =========================================================
       SINGLE PRODUCT PAGE (PDP) — PAGE-ONLY STYLES
    ========================================================= */
    .up-pdp-section { padding-top: 28px; padding-bottom: 48px; }

    /* ---- 2-column layout: gallery left, info right ---- */
    .up-pdp {
        display: grid !important;
        grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
        gap: 48px;
        align-items: flex-start;
    }

    /* ---- Gallery ---- */
    .up-pdp__gallery {
        display: flex !important;
        gap: 12px;
        position: sticky;
        top: 20px;         /* keeps gallery in view while scrolling through long info */
    }

    .up-pdp__thumbs {
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex: 0 0 auto;
    }

    .up-pdp__thumb {
        width: 64px;
        height: 80px;
        padding: 0;
        border: 1.5px solid var(--up-line);
        border-radius: 2px;
        background: #f0eee8;
        overflow: hidden;
        cursor: pointer;
        opacity: .65;
        transition: opacity .15s, border-color .15s;
        flex: 0 0 auto;
    }
    .up-pdp__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .up-pdp__thumb:hover { opacity: 1; }
    .up-pdp__thumb.is-active {
        opacity: 1;
        border-color: var(--up-black);
    }

    .up-pdp__main-img {
        position: relative;
        flex: 1 1 auto;
        aspect-ratio: 3/4;
        background: #f0eee8;
        overflow: hidden;
        border-radius: 2px;
    }
    .up-pdp__main-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity .2s ease;
    }

    .up-pdp__no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 700;
        color: #c9c5b8;
    }

    .up-pdp__wish {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .92);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #1a1a1a;
        transition: background .15s;
    }
    .up-pdp__wish:hover { background: #fff; }

    /* ---- Info column ---- */
    .up-pdp__meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }
    .up-pdp__brand {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--up-muted);
    }
    .up-pdp__category {
        font-size: 10.5px;
        font-weight: 600;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: var(--up-muted);
        padding: 2px 8px;
        border: 1px solid var(--up-line);
        border-radius: 2px;
    }
    .up-pdp__category:hover { border-color: #999; color: var(--up-black); }

    .up-pdp__name {
        font-size: 22px;
        font-weight: 600;
        letter-spacing: .01em;
        color: #1a1a1a;
        line-height: 1.35;
        margin-bottom: 14px;
    }

    .up-pdp__price-row {
        display: flex;
        align-items: baseline;
        gap: 14px;
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--up-line);
    }
    .up-pdp__price {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
    }
    .up-pdp__sku {
        font-size: 11px;
        color: var(--up-muted);
    }

    .up-pdp__desc {
        font-size: 13px;
        color: #3a3a3a;
        line-height: 1.65;
        margin-bottom: 18px;
    }

    .up-pdp__details {
        list-style: none;
        margin: 0 0 26px;
        padding: 0;
        border-top: 1px solid var(--up-line);
        padding-top: 16px;
    }
    .up-pdp__details li {
        font-size: 12.5px;
        color: #3a3a3a;
        padding-left: 16px;
        position: relative;
        margin-bottom: 8px;
        line-height: 1.4;
    }
    .up-pdp__details li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 7px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--up-muted);
    }

    /* ---- Enquiry form ---- */
    .up-pdp__enquiry {
        background: var(--up-bg);
        border: 1px solid var(--up-line);
        border-radius: 4px;
        padding: 22px;
    }

    .up-pdp__enquiry-title {
        font-size: 15px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 5px;
    }
    .up-pdp__enquiry-sub {
        font-size: 12px;
        color: var(--up-muted);
        line-height: 1.5;
        margin-bottom: 18px;
    }

    .up-pdp__alert {
        padding: 10px 14px;
        border-radius: 3px;
        font-size: 12.5px;
        margin-bottom: 16px;
    }
    .up-pdp__alert--success {
        background: #e8f3e8;
        border: 1px solid #b9ddb9;
        color: #2c5e2c;
    }
    .up-pdp__alert--error {
        background: #fdecea;
        border: 1px solid #f5c6c2;
        color: #8b1a1a;
    }

    .up-pdp__form-row {
        margin-bottom: 14px;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .up-pdp__form-row--split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 0;
    }
    .up-pdp__form-row--split > div {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-bottom: 14px;
    }

    .up-pdp__form-row label,
    .up-pdp__form-row--split label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .03em;
        text-transform: uppercase;
        color: #4a4a4a;
    }
    .up-pdp__req { color: #c0392b; }
    .up-pdp__optional {
        font-weight: 400;
        text-transform: none;
        letter-spacing: 0;
        color: var(--up-muted);
    }

    .up-pdp__form-row input,
    .up-pdp__form-row textarea,
    .up-pdp__form-row--split input {
        padding: 9px 11px;
        font-size: 13px;
        font-family: inherit;
        border: 1px solid #d4d1c8;
        border-radius: 2px;
        background: #fff;
        color: #1a1a1a;
        outline: none;
        resize: vertical;
        transition: border-color .15s;
    }
    .up-pdp__form-row input:focus,
    .up-pdp__form-row textarea:focus,
    .up-pdp__form-row--split input:focus { border-color: var(--up-black); }
    .up-pdp__form-row input.is-invalid,
    .up-pdp__form-row--split input.is-invalid { border-color: #c0392b; }

    .up-pdp__field-error {
        font-size: 11px;
        color: #c0392b;
    }

    .up-pdp__submit {
        background: var(--up-black);
        color: #fff;
        border: none;
        width: 100%;
        text-align: center;
        margin-top: 4px;
        cursor: pointer;
        padding: 13px 24px;
        font-size: 12px;
        letter-spacing: .06em;
    }
    .up-pdp__submit:hover { background: #2a2a2a; }

    /* ---- Breadcrumb (reuses global .up-breadcrumb from layout) ---- */
    .up-pdp__no-image {
        aspect-ratio: 3/4;
        background: #f0eee8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 700;
        color: #c9c5b8;
    }

    /* ---- Responsive ---- */
    @media (max-width: 1024px) {
        .up-pdp {
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }
    }

    @media (max-width: 768px) {
        .up-pdp {
            grid-template-columns: 1fr !important;
            gap: 24px;
        }

        /* Gallery flips: thumbnails become a horizontal row below main image */
        .up-pdp__gallery {
            flex-direction: column-reverse;
            position: static;
        }
        .up-pdp__thumbs {
            flex-direction: row;
            overflow-x: auto;
            gap: 8px;
            padding-bottom: 4px;
            scrollbar-width: none;
        }
        .up-pdp__thumbs::-webkit-scrollbar { display: none; }
        .up-pdp__thumb {
            width: 54px;
            height: 68px;
        }

        .up-pdp__name { font-size: 18px; }
        .up-pdp__price { font-size: 18px; }
        .up-pdp__enquiry { padding: 18px; }

        .up-pdp__form-row--split {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Thumbnail click → swap main image with smooth opacity transition
    document.addEventListener('DOMContentLoaded', function () {
        const thumbsWrap = document.getElementById('up-pdp-thumbs');
        const mainImg    = document.getElementById('up-pdp-main-img');

        if (thumbsWrap && mainImg) {
            thumbsWrap.querySelectorAll('.up-pdp__thumb').forEach(function (thumb) {
                thumb.addEventListener('click', function () {
                    const newSrc = thumb.getAttribute('data-img');
                    if (!newSrc || newSrc === mainImg.getAttribute('src')) return;

                    // Smooth swap
                    mainImg.style.opacity = '0';
                    setTimeout(function () {
                        mainImg.setAttribute('src', newSrc);
                        mainImg.style.opacity = '1';
                    }, 150);

                    // Update active state
                    thumbsWrap.querySelectorAll('.up-pdp__thumb').forEach(function (t) {
                        t.classList.remove('is-active');
                    });
                    thumb.classList.add('is-active');
                });
            });
        }
    });
</script>
@endpush