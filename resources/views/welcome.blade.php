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
            <p class="small-title">Roadmap</p>
            <p>Roadmap</p>
        </section>
        <hr>
    </main>
    @livewire('products.product-page')
</x-layouts.standard>
