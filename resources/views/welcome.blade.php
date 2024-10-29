<x-layouts.standard>
    {{-- <section class="section">
        @livewire('announcements.carousel')
    </section> --}}
    <section class="section">
        <h3 class="bold">A Market at your fingertips.</h3>
        <h5 class="paragraph">Cut your commute, stress, and market list in half</h5>
    </section>
    <section  id="feature">
        @livewire('products.feature', ['find' => 'popular'])
    </section>
    <hr>
    {{-- <section class="section">
        @livewire('sections.explore', ['find' => 'popular'])
    </section> --}}
    <hr>
    {{-- <section class="appeal">
        <div>
            <h4 class="bold">More than a website..</h4>
            <h5>We're on a mission to revolutionaize the way you go about shopping </h5>
            <p class="paragraph">
                At Fresh2GoHub we saw a great opportunity to leverage the ecommerce landscape of things and have
                that compliment our business the right way. Shopping online should be rewarding and straight
                forward, so we're always looking to make the experience a great one!
            </p>
        </div>
    </section>
    <hr>
    <section>
        @livewire('helpers.section',['title'=>'about','subtitle'=>'We are','text'=>'A company dedicated to '])
    </section>
    <hr>
    <section>
        @livewire('helpers.section',['title'=>'Contact','subtitle'=>'Here are some ways to get in touch','text'=>'A company dedicated to '])
    </section>
    <hr> --}}
    <section class="section" id="features">
        <h4 class="bold"> Roadmap</h4>
        <h5 class="paragraph">Here's what were working on right now</h5>
        <div id="roadmap">
            {{-- Milestone 1 --}}
            <div class="rm">
                <p class="bold">Site Achievements</p>
                <p>The more you're here the more you'll be rewarded!</p>
                </span>
            </div>
            {{-- Milestone 2 --}}
            <div class="rm">
                <p class="bold">User preferences</p>
                <p>We'll be working on a comprehensive profile section for new users to manage their
                    preferences, coupons and more!</p>
            </div>
            {{-- --- --}}
        </div>
    </section>
    <hr>
    @livewire('products.product-page')
</x-layouts.standard>
