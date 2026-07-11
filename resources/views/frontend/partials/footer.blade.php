{{-- ============================================================
     PARTIAL: FOOTER
     resources/views/partials/footer.blade.php

     Footer, shared across every page. Included via
     @include('partials.footer').
============================================================ --}}

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

        {{-- <div class="up-footer-bottom__cols">
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
        </div> --}}

        <p class="up-footer-bottom__copy">© {{ date('Y') }} UPSWEP Retail Ltd. All rights reserved.</p>
    </div>
</footer>