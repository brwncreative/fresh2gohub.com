<x-layouts.standard>
    {{-- <section class="section">
        @livewire('announcements.carousel')
    </section> --}}
    {{-- Introduction --}}
    <section class="section">
        <h4 style="font-weight: 600">Welcome to Fresh2GoHub, <span class="bold"
                style="text-decoration:underline">your</span> e-market!</h4>
        <h5 class="paragraph">See our wide array of options and cut your commute and stress from the equation</h5>
    </section>
    {{-- Feature Popular --}}
    <section id="feature">
        @livewire('products.feature', ['find' => 'popular'])
    </section>
    <hr>
    <section id="mailing" class="explore"> @livewire('sections.explore')</section>
    <hr>
    {{-- About Us --}}
    <section id="about-us" class="appeal">
        <h5 class="bold">About Us</h5>
        <h6>You deserve to think more about the food and worry less about the quality</h6>
        <p class="paragraph" style="margin-top:.5rem">
            Welcome to Fresh2Go Hub – your destination for premium prepped foods that bring flavor, convenience, and
            quality to your kitchen. We specialize in a curated selection of freshly prepped fruits, vegetables, meats,
            salts, and marinades, designed to elevate your culinary experience with ease and excellence.
            At Fresh2Go Hub, we believe that great food starts with the freshest ingredients. That’s why we carefully
            source each product and prepare it with attention to detail, ensuring that you can enjoy quick and delicious
            meals without compromising on quality. Whether you’re a busy professional, a home cook, or a food
            enthusiast, our goal is to provide you with ingredients that help you create wholesome, tasty meals in no
            time.
            We’re dedicated to making meal prep simple and sustainable by offering portioned, prepped ingredients that
            cut down on food waste and cooking time. Thank you for choosing Fresh2Go Hub – where freshness and flavor
            are always within reach.
        </p>
    </section>
    <hr>
    {{-- Contact us --}}
    <section id="contact-us" class="appeal">
        <h5 class="bold">Contact Us</h5>
        <p class="paragraph">
            We’re here to help! Whether you have a question about our products, need assistance with an order, or want
            to share feedback, please reach out to us. We value your experience with Fresh2Go Hub and are committed to
            providing prompt, friendly support.
        </p>
        <div class="mini-divider"></div>
        <ol>
            <li>
                <p class="heading bold">Customer Support Email</p>
                <p class="context">
                <ul class="paragraph">
                    <li>Email: support@fresh2gohub.com</li>
                    <li>Hours: Monday - Friday, 8:00 AM - 6:00 PM</li>
                </ul>
                </p>
            </li>
            <li>
                <p class="heading bold">Phone Support</p>
                <p class="context">
                <ul class="paragraph">
                    <li>Phone Number: +1 (868) 477 7043</li>
                    <li>Hours: Monday - Friday, 8:00 AM - 6:00 PM</li>
                </ul>
                </p>
            </li>
            <li>
                <p class="heading bold">Social Media</p>
                <p class="context">
                <ul class="paragraph">
                    <li>Facebook: <a href="https://www.facebook.com/profile.php?id=61560308751020">Fresh2GoHub</a> </li>
                    <li>Instagram: <a href="https://www.instagram.com/fresh2gohub?igsh=MWxhYTVqcTVqNDZxMg==">@Fresh2GoHub</a></li>
                </ul>
                </p>
            </li>
        </ol>
        <div class="notice">
            <p class="heading bold"></p>
            <p class="context"></p>
        </div>
        <div class="notice">
            <p class="heading bold"></p>
            <p class="context"></p>
        </div>
    </section>
    <hr>
    {{-- Features --}}
    <section class="section" id="features">
        <h5 class="bold"> Roadmap</h5>
        <h6 class="paragraph">Here's what were working on right now</h6>
        <div id="roadmap">
            {{-- Milestone 1 --}}
            <div class="rm">
                <i class="bi bi-info-circle"></i>
                <p class="bold">Site Achievements</p>
                <p class="text">The more you're here the more you'll be rewarded!</p>
                </span>
            </div>
            {{-- Milestone 2 --}}
            <div class="rm">
                <i class="bi bi-info-circle"></i>
                <p class="bold">User preferences</p>
                <p class="text">We'll be working on a comprehensive profile section for new users to manage their
                    preferences, coupons and more!</p>
            </div>
            {{-- --- --}}
        </div>
    </section>
    <hr>

    {{-- Link Behavior --}}
    @if (Route::is('more'))
        <script>
            document.getElementById('mailing').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        </script>
    @endif
    @if (Route::is('about'))
        <script>
            document.getElementById('about-us').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        </script>
    @endif
    @if (Route::is('contact'))
        <script>
            document.getElementById('contact-us').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        </script>
    @endif

    @livewire('products.product-page')
</x-layouts.standard>
