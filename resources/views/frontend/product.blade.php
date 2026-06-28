@extends('frontend.layouts.front')

@section('title', $product['name'] ?? 'UPSWEP — Product')
@section('description', 'Browse our latest collection of shirts, hoodies, jeans, footwear and accessories.')

@section('content')

{{-- ============================================================
     UPSWEP SINGLE PRODUCT PAGE (PDP)
     resources/views/frontend/product.blade.php

     Structure: Header (partial) -> Breadcrumb -> Gallery + Info
     (classic layout: big image left with thumbnail strip, product
     details + enquiry form right) -> Footer (partial)

     No cart/checkout here by design — Phase 1 scope is enquiry-
     only (per the project plan): customer views product, submits
     an enquiry, dealer follows up. Koko/payment integration is a
     later phase.

     Global header/nav/footer/tokens/buttons all come from the
     layout + partials, same pattern as index.blade.php and
     grid.blade.php. Only PDP-specific markup + CSS live here.

     Placeholder data for now — swap $product for a real Eloquent
     find()/findOrFail() once the Product model is wired up, e.g.:
     $product = Product::with(['category', 'brand', 'images'])
         ->where('slug', $slug)->firstOrFail();
============================================================ --}}

<div class="upswep-home upswep-pdp">

    @php
        // ----------------------------------------------------------
        // PLACEHOLDER DATA — replace with a real Eloquent query in
        // the controller once Product/Category/Brand models exist.
        // The @forelse/@if blocks below already branch on is_array()
        // so swapping in a real model needs zero template changes.
        // ----------------------------------------------------------
        $product = $product ?? [
            'name' => 'White Button Down Collar Cotton Linen Blend Short Sleeve Shirt',
            'brand' => 'BrandTwo',
            'category' => 'Shirts',
            'price' => 28.00,
            'sku' => 'UPS-SH-0142',
            'description' => 'A relaxed, breathable shirt made from a cotton-linen blend, finished with a button-down collar and a single chest pocket. Easy to dress up or down — wear open over a tee for warm-weather days, or buttoned with chinos for a smarter look.',
            'details' => [
                'Cotton-linen blend fabric',
                'Button-down collar',
                'Single chest pocket',
                'Regular fit',
                'Machine washable',
            ],
            'images' => [
                asset('images/products/1.jpg'),
                asset('images/products/2.jpg'),
                asset('images/products/3.jpg'),
                asset('images/products/4.jpg'),
            ],
        ];

        $images = is_array($product) ? $product['images'] : $product->images;
        $primaryImage = is_array($images) ? ($images[0] ?? null) : $images->first()?->image_path;
    @endphp

    @include('frontend.partials.header')

    {{-- ============ BREADCRUMB ============ --}}
    <div class="up-breadcrumb mt-3">
        <div class="up-container">
            <a href="{{ url('/') }}">Home</a>
            <span class="up-breadcrumb__sep">/</span>
            <a href="{{ url('/products') }}">{{ is_array($product) ? $product['category'] : $product->category?->name }}</a>
            <span class="up-breadcrumb__sep">/</span>
            <span>{{ is_array($product) ? $product['name'] : $product->name }}</span>
        </div>
    </div>

    {{-- ============ PRODUCT MAIN: GALLERY + INFO ============ --}}
    <section class="up-section up-pdp-section">
        <div class="up-container">
            <div class="up-pdp">

                {{-- ---- Gallery: thumbnails + big image ---- --}}
                <div class="up-pdp__gallery">
                    <div class="up-pdp__thumbs" id="up-pdp-thumbs">
                     @foreach ($images as $i => $img)
    <button type="button"
        class="up-pdp__thumb {{ $i === 0 ? 'is-active' : '' }}"
        data-img="{{ is_string($img) ? $img : $img->image_path }}"
        aria-label="View image {{ $i + 1 }}">
        <img src="{{ is_string($img) ? $img : $img->image_path }}" alt="Thumbnail {{ $i + 1 }}">
    </button>
@endforeach
                    </div>

                    <div class="up-pdp__main-img">
                        <img src="{{ $primaryImage }}" alt="{{ is_array($product) ? $product['name'] : $product->name }}" id="up-pdp-main-img">
                        <button type="button" class="up-pdp__wish" aria-label="Add to wishlist">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path d="M12 21s-7.5-4.6-10-9.3C.6 8.2 2.4 4.5 6 4c2.2-.3 4.2 1 6 3.1C13.8 5 15.8 3.7 18 4c3.6.5 5.4 4.2 4 7.7C19.5 16.4 12 21 12 21z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- ---- Product info + enquiry form ---- --}}
                <div class="up-pdp__info">
                    <span class="up-pdp__brand">{{ is_array($product) ? $product['brand'] : $product->brand?->name }}</span>
                    <h1 class="up-pdp__name">{{ is_array($product) ? $product['name'] : $product->name }}</h1>

                    <div class="up-pdp__price-row">
                        <span class="up-pdp__price">£{{ number_format(is_array($product) ? $product['price'] : $product->price, 2) }}</span>
                        @if(is_array($product) && !empty($product['sku']))
                            <span class="up-pdp__sku">SKU: {{ $product['sku'] }}</span>
                        @endif
                    </div>

                    <p class="up-pdp__desc">{{ is_array($product) ? $product['description'] : $product->description }}</p>

                    @if (is_array($product) && !empty($product['details']))
                        <ul class="up-pdp__details">
                            @foreach ($product['details'] as $line)
                                <li>{{ $line }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- ---- Enquiry form ----
                         Phase 1: saves to the enquiries table, tied to this
                         product. No cart, no payment — dealer follows up
                         manually via the admin panel. Replace the action
                         below with your real route, e.g. route('enquiries.store'). --}}
                    <div class="up-pdp__enquiry">
                        <h2 class="up-pdp__enquiry-title">Interested in this item?</h2>
                        <p class="up-pdp__enquiry-sub">Send us your details and we'll get back to you about availability and pricing.</p>

                        <form method="POST" action="{{ \Illuminate\Support\Facades\Route::has('enquiries.store') ? route('enquiries.store') : '#' }}" class="up-pdp__form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ is_array($product) ? ($product['id'] ?? '') : $product->id }}">

                            <div class="up-pdp__form-row">
                                <label for="enq_name">Name</label>
                                <input type="text" id="enq_name" name="name" required placeholder="Your full name">
                            </div>

                            <div class="up-pdp__form-row up-pdp__form-row--split">
                                <div>
                                    <label for="enq_phone">Phone</label>
                                    <input type="tel" id="enq_phone" name="phone" required placeholder="07X XXX XXXX">
                                </div>
                                <div>
                                    <label for="enq_email">Email <span class="up-pdp__optional">(optional)</span></label>
                                    <input type="email" id="enq_email" name="email" placeholder="you@example.com">
                                </div>
                            </div>

                            <div class="up-pdp__form-row">
                                <label for="enq_message">Message <span class="up-pdp__optional">(optional)</span></label>
                                <textarea id="enq_message" name="message" rows="3" placeholder="Any specific questions — size, colour, availability..."></textarea>
                            </div>

                            <button type="submit" class="up-btn up-pdp__submit">SEND ENQUIRY</button>
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
       Global tokens/header/nav/buttons/footer already come from
       layouts/front.blade.php. Only PDP-specific rules live here:
       gallery, product info, and the enquiry form. Kept deliberately
       restrained — no extra ornamentation beyond the existing
       design language (same muted palette, same type scale).
    ========================================================= */

    .up-pdp-section { padding-top: 28px; }

    .up-pdp {
        display: grid !important;
        grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
        gap: 48px;
        align-items: flex-start;
    }

    /* ---- Gallery ---- */
    .up-pdp__gallery {
        display: flex !important;
        gap: 14px;
    }

    .up-pdp__thumbs {
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 0 0 auto;
    }

    .up-pdp__thumb {
        width: 64px;
        height: 80px;
        padding: 0;
        border: 1px solid var(--up-line);
        border-radius: 2px;
        background: #f0eee8;
        overflow: hidden;
        cursor: pointer;
        opacity: .7;
        transition: opacity .15s, border-color .15s;
    }
    .up-pdp__thumb img { width: 100%; height: 100%; object-fit: cover; }
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
    }
    .up-pdp__main-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .up-pdp__wish {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .92);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #1a1a1a;
    }
    .up-pdp__wish:hover { background: #fff; }

    /* ---- Info column ---- */
    .up-pdp__brand {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--up-muted);
    }

    .up-pdp__name {
        font-size: 22px;
        font-weight: 600;
        letter-spacing: .01em;
        color: #1a1a1a;
        margin-top: 6px;
        margin-bottom: 14px;
        line-height: 1.35;
    }

    .up-pdp__price-row {
        display: flex;
        align-items: baseline;
        gap: 14px;
        margin-bottom: 18px;
    }
    .up-pdp__price {
        font-size: 20px;
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
        margin: 0 0 28px;
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
        width: 5px;
        height: 5px;
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
        letter-spacing: .01em;
        color: #1a1a1a;
        margin-bottom: 6px;
    }

    .up-pdp__enquiry-sub {
        font-size: 12px;
        color: var(--up-muted);
        line-height: 1.5;
        margin-bottom: 18px;
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
        gap: 14px;
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

    .up-pdp__optional {
        font-weight: 500;
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
    }
    .up-pdp__form-row input:focus,
    .up-pdp__form-row textarea:focus,
    .up-pdp__form-row--split input:focus {
        border-color: var(--up-black);
    }

    .up-pdp__submit {
        background: var(--up-black);
        color: #fff;
        border: none;
        width: 100%;
        text-align: center;
        margin-top: 4px;
        cursor: pointer;
    }
    .up-pdp__submit:hover {
        background: #2a2a2a;
    }

    /* ---- Responsive ---- */
    @media (max-width: 1100px) {
        .up-pdp { grid-template-columns: 1fr; gap: 32px; }
    }

    @media (max-width: 768px) {
        .up-pdp-section { padding-top: 18px; }

        .up-pdp__gallery {
            flex-direction: column-reverse;
        }
        .up-pdp__thumbs {
            flex-direction: row;
            overflow-x: auto;
        }
        .up-pdp__thumb {
            width: 56px;
            height: 70px;
            flex: 0 0 auto;
        }

        .up-pdp__name { font-size: 18px; }
        .up-pdp__price { font-size: 17px; }

        .up-pdp__form-row--split {
            grid-template-columns: 1fr;
        }
        .up-pdp__form-row--split > div {
            margin-bottom: 0;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // =========================================================
    // SINGLE PRODUCT PAGE JS
    // - thumbnail click swaps the main image + active state
    // - everything else (drag-scroll, mobile search, checkout)
    //   is already global, see layouts/front.blade.php
    // =========================================================
    document.addEventListener('DOMContentLoaded', function () {
        const thumbsWrap = document.getElementById('up-pdp-thumbs');
        const mainImg = document.getElementById('up-pdp-main-img');

        if (thumbsWrap && mainImg) {
            thumbsWrap.querySelectorAll('.up-pdp__thumb').forEach(function (thumb) {
                thumb.addEventListener('click', function () {
                    const newSrc = thumb.getAttribute('data-img');
                    if (newSrc) {
                        mainImg.setAttribute('src', newSrc);
                    }
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