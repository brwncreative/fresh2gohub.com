<x-layouts.standard>
    <main>
        <section id="welcome">
            @livewire('sections.explore', ['find' => 'popular'])
        </section>
        <hr>
        <section>
            <div>
                <p class="title">More than a website..</p>
                <p>We're on a mission to revolutionaize the way you go about shopping </p>
                <p class="paragraph">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Praesentium vel maxime veniam itaque
                    dolores, fugiat rerum natus possimus quis. Quaerat iusto repudiandae neque exercitationem culpa
                    quibusdam quis eaque voluptate molestias.
                </p>
            </div>
        </section>
        <hr>
    </main>
    @livewire('products.product-page')
</x-layouts.standard>
