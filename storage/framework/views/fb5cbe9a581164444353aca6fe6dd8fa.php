

<?php $__env->startSection('title', 'Products - UPSWEP'); ?>
<?php $__env->startSection('description', 'Browse our latest collection of shirts, hoodies, jeans, footwear and accessories.'); ?>

<?php $__env->startSection('content'); ?>



<div class="upswep-home upswep-contact">

    <?php echo $__env->make('frontend.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="up-breadcrumb mt-3">
        <div class="up-container">
            <a href="<?php echo e(url('/')); ?>">Home</a>
            <span class="up-breadcrumb__sep">/</span>
            <span>Contact</span>
        </div>
    </div>

    
    <div class="up-plp-head">
        <div class="up-container">
            <h1 class="up-plp-head__title">Contact Us</h1>
            <p class="up-plp-head__intro">
                Have a question about a product, an order, or anything else? Send us a message and our team
                will get back to you as soon as possible.
            </p>
        </div>
    </div>

    
    <section class="up-section up-contact-section">
        <div class="up-container">
            <div class="up-contact">

                
                <div class="up-contact__form-card">
                    <h2 class="up-contact__form-title">Send us a message</h2>
                    <p class="up-contact__form-sub">Fill out the form below and we'll respond within 1-2 business days.</p>

                    <?php if(session('success')): ?>
                        <div class="up-contact__alert"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(\Illuminate\Support\Facades\Route::has('contact.store') ? route('contact.store') : '#'); ?>" class="up-contact__form">
                        <?php echo csrf_field(); ?>

                        <div class="up-contact__form-row">
                            <label for="contact_name">Name</label>
                            <input type="text" id="contact_name" name="name" required placeholder="Your full name">
                        </div>

                        <div class="up-contact__form-row up-contact__form-row--split">
                            <div>
                                <label for="contact_email">Email</label>
                                <input type="email" id="contact_email" name="email" required placeholder="you@example.com">
                            </div>
                            <div>
                                <label for="contact_phone">Phone <span class="up-contact__optional">(optional)</span></label>
                                <input type="tel" id="contact_phone" name="phone" placeholder="07X XXX XXXX">
                            </div>
                        </div>

                        <div class="up-contact__form-row">
                            <label for="contact_subject">Subject</label>
                            <select id="contact_subject" name="subject">
                                <option value="general">General Enquiry</option>
                                <option value="order">Order Question</option>
                                <option value="product">Product Question</option>
                                <option value="returns">Returns &amp; Exchanges</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="up-contact__form-row">
                            <label for="contact_message">Message</label>
                            <textarea id="contact_message" name="message" rows="5" required placeholder="How can we help?"></textarea>
                        </div>

                        <button type="submit" class="up-btn up-contact__submit">SEND MESSAGE</button>
                    </form>
                </div>

                
                <div class="up-contact__info">

                   <div class="up-contact__info-row">

    <div class="up-contact__info-block">
        <h3>Visit Our Store</h3>
        <p>
            123 High Street<br>
            Colombo 03<br>
            Sri Lanka
        </p>
    </div>

    <div class="up-contact__info-block">
        <h3>Get In Touch</h3>
        <p>
            <a href="tel:+94112345678">+94 11 234 5678</a><br>
            <a href="mailto:hello@upswep.com">hello@upswep.com</a>
        </p>
    </div>

</div>

                    <div class="up-contact__info-block">
                        <h3>Opening Hours</h3>
                        <ul class="up-contact__hours">
                            <li><span>Monday – Friday</span><span>9:00 AM – 7:00 PM</span></li>
                            <li><span>Saturday</span><span>9:00 AM – 6:00 PM</span></li>
                            <li><span>Sunday</span><span>Closed</span></li>
                        </ul>
                    </div>

                    <div class="up-contact__map">
                        <iframe
                            src="https://www.google.com/maps?q=Colombo,Sri+Lanka&output=embed"
                            width="100%" height="260" style="border:0;" allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="UPSWEP store location">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php echo $__env->make('frontend.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* =========================================================
       CONTACT PAGE — PAGE-ONLY STYLES
       Global tokens/header/nav/buttons/footer already come from
       layouts/front.blade.php. .up-breadcrumb and .up-plp-head
       are reused as-is from the products page for visual
       consistency (same title/intro treatment across pages).
       Only the form + store info/map layout is new here.
    ========================================================= */

    .up-contact__info-row{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:24px;
    margin-bottom:20px;
}

.up-contact__info-row .up-contact__info-block{
    margin-bottom:0;
    padding-bottom:18px;
    border-bottom:1px solid var(--up-line);
}

@media (max-width:768px){
    .up-contact__info-row{
        grid-template-columns:1fr;
        gap:16px;
    }
}

    .up-contact-section { padding-top: 28px; }

    .up-contact {
        display: grid !important;
        grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr);
        gap: 40px;
        align-items: flex-start;
    }

    /* ---- Form card ---- */
    .up-contact__form-card {
        background: var(--up-bg);
        border: 1px solid var(--up-line);
        border-radius: 4px;
        padding: 28px;
    }

    .up-contact__form-title {
        font-size: 17px;
        font-weight: 700;
        letter-spacing: .01em;
        color: #1a1a1a;
        margin-bottom: 6px;
    }

    .up-contact__form-sub {
        font-size: 12.5px;
        color: var(--up-muted);
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .up-contact__alert {
        background: #e8f3e8;
        border: 1px solid #b9ddb9;
        color: #2c5e2c;
        font-size: 12.5px;
        padding: 10px 14px;
        border-radius: 3px;
        margin-bottom: 18px;
    }

    .up-contact__form-row {
        margin-bottom: 16px;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .up-contact__form-row--split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 0;
    }
    .up-contact__form-row--split > div {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-bottom: 16px;
    }

    .up-contact__form-row label,
    .up-contact__form-row--split label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .03em;
        text-transform: uppercase;
        color: #4a4a4a;
    }

    .up-contact__optional {
        font-weight: 500;
        text-transform: none;
        letter-spacing: 0;
        color: var(--up-muted);
    }

    .up-contact__form-row input,
    .up-contact__form-row select,
    .up-contact__form-row textarea,
    .up-contact__form-row--split input {
        padding: 10px 12px;
        font-size: 13px;
        font-family: inherit;
        border: 1px solid #d4d1c8;
        border-radius: 2px;
        background: #fff;
        color: #1a1a1a;
        outline: none;
        resize: vertical;
    }
    .up-contact__form-row input:focus,
    .up-contact__form-row select:focus,
    .up-contact__form-row textarea:focus,
    .up-contact__form-row--split input:focus {
        border-color: var(--up-black);
    }

    .up-contact__submit {
        background: var(--up-black);
        color: #fff;
        border: none;
        width: 100%;
        text-align: center;
        margin-top: 4px;
        cursor: pointer;
    }
    .up-contact__submit:hover {
        background: #2a2a2a;
    }

    /* ---- Store info ---- */
    .up-contact__info-block {
        padding-bottom: 18px;
        margin-bottom: 18px;
        border-bottom: 1px solid var(--up-line) !important;
        
    }
    .up-contact__info-block:last-of-type {
        border-bottom: none;
    }

    .up-contact__info-block h3 {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .up-contact__info-block p,
    .up-contact__info-block a {
        font-size: 13px;
        color: #3a3a3a;
        line-height: 1.6;
    }
    .up-contact__info-block a:hover {
        color: var(--up-black);
        text-decoration: underline;
    }

    .up-contact__hours {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .up-contact__hours li {
        display: flex;
        justify-content: space-between;
        font-size: 12.5px;
        color: #3a3a3a;
        padding: 4px 0;
    }
    .up-contact__hours li span:first-child {
        color: var(--up-muted);
    }

    .up-contact__map {
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid var(--up-line);
        line-height: 0;
    }
    .up-contact__map iframe {
        display: block;
    }

    /* ---- Responsive ---- */
    @media (max-width: 1100px) {
        .up-contact { grid-template-columns: 1fr; gap: 32px; }
    }

    @media (max-width: 768px) {
        .up-contact-section { padding-top: 18px; }
        .up-contact__form-card { padding: 20px; }

        .up-contact__form-row--split {
            grid-template-columns: 1fr;
        }
        .up-contact__form-row--split > div {
            margin-bottom: 0;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Personal Projects\Upswep\upswep-fe\resources\views/frontend/contact.blade.php ENDPATH**/ ?>