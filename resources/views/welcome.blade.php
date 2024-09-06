<x-layouts.standard>
    <main>
        <section id="welcome">
            @livewire('sections.explore', ['find'=>'popular'])
            <x-helpers.notification title='Site version v1'
            text='This site is in its early stages, give us some feedback on how we can improve!'></x-helpers.notification>
        </section>
    </main>
    @livewire('products.product-page')
</x-layouts.standard>
