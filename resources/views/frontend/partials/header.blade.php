{{-- ============================================================
     PARTIAL: HEADER
     resources/views/partials/header.blade.php

     Topbar + main nav, shared across every page (home, products,
     future pages). Included via @include('partials.header').

     The "is-active" class on a nav link is set dynamically using
     request()->is(...) so the correct link highlights on whatever
     page is currently loaded, instead of being hardcoded to HOME.
============================================================ --}}

{{-- ============ TOP UTILITY BAR ============ --}}
<div class="up-topbar">
    <div class="up-topbar__inner">
        <span>We accept</span>
        <span class="up-pay-icons">
            <img src="{{ asset('images/visa.png') }}" alt="Visa" style="height: 14px;">
        </span>
    </div>
</div>

{{-- ============ MAIN NAV ============ --}}
<header class="up-header">
    <div class="up-header__row up-header__row--top">
        <form class="up-search" method="GET" action="{{ url('/products') }}" role="search">
            <input type="text" name="q"
                value="{{ request('q') }}"
                placeholder="Search for anything here..."
                autocomplete="off">
            <button type="submit" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="10.5" cy="10.5" r="6.5"></circle>
                    <path d="M15.5 15.5L21 21"></path>
                </svg>
            </button>
        </form>

        <a href="{{ url('/') }}" class="up-logo">UPSWEP</a>

        <div class="up-header__icons">
            <a href="#" aria-label="Wishlist" class="up-social-like">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path
                        d="M12 21s-7.5-4.6-10-9.3C.6 8.2 2.4 4.5 6 4c2.2-.3 4.2 1 6 3.1C13.8 5 15.8 3.7 18 4c3.6.5 5.4 4.2 4 7.7C19.5 16.4 12 21 12 21z" />
                </svg>
            </a>
            <a href="#" aria-label="Account">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="8" r="3.4" />
                    <path d="M4.5 20c1.3-3.6 4.4-5.6 7.5-5.6s6.2 2 7.5 5.6" />
                </svg>
            </a>
            <a href="#" aria-label="Bag">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 8h12l-1 12H7L6 8z" />
                    <path d="M9 8V6a3 3 0 0 1 6 0v2" />
                </svg>
            </a>
            <button type="button" class="up-checkout-btn">CHECKOUT</button>
        </div>
    </div>

    <nav class="up-header__row up-header__row--nav">
        <ul class="up-nav">
            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'is-active' : '' }}">HOME</a></li>
            <li><a href="{{ url('/products') }}" class="{{ request()->is('products') ? 'is-active' : '' }}">PRODUCTS</a></li>
            {{-- <li><a href="#">BRANDS</a></li> --}}
            <li><a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'is-active' : '' }}">CONTACT</a></li>
        </ul>
    </nav>
</header>