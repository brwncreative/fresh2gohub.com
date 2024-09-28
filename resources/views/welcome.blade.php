<x-layouts.standard>
    <main>
        <section id="welcome">
            @livewire('sections.explore', ['find' => 'popular'])
        </section>
        <hr>
        <section>
            <div>
                <p class="medium-title">More than a website..</p>
                <p>We're on a mission to revolutionaize the way you go about shopping </p>
                <p class="paragraph">
                    At Fresh2GoHub we saw a great opportunity to leverage the ecommerce landscape of things and have
                    that compliment our business the right way. Shopping online should be rewarding and straight
                    forward, so we're always looking to make the experience a great one!
                </p>
            </div>
        </section>
        <hr>
        <section>
            <p class="medium-title">Roadmap</p>
            <p>Here's what were working on right now</p>
            <div id="roadmap">
                {{-- Milestone 1 --}}
                <div class="rm rm-1">
                    <span class="point">
                        <div class="l" style="border-radius: 10px 10px 0 0"></div>
                        <div class="p"></div>
                    </span>
                    <span class="milestone">
                        <div class="milestone-container">
                            <p class="small-title">Site Achievements</p>
                            <p>The more you're here the more you'll be rewarded!</p>
                        </div>
                    </span>
                </div>
                {{-- --- --}}
                {{-- Milestone 2 --}}
                <div class="rm rm-2">
                    <span class="point">
                        <div class="l"></div>
                        <div class="p"></div>
                    </span>
                    <span class="milestone">
                        <div class="milestone-container">
                            <p class="small-title">User preferences</p>
                            <p>We'll be working on a comprehensive profile section for new users to manage their
                                preferences, coupons and more!</p>
                        </div>
                    </span>
                </div>
                {{-- --- --}}
            </div>
        </section>
        <hr>
    </main>
    @livewire('products.product-page')
</x-layouts.standard>
