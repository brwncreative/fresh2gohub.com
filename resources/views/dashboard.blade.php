<x-layouts.dashboard>
    @switch($purpose)
        @case('/')
            @livewire('dashboard.welcome')
        @break

        @case('products')
            @livewire('dashboard.products')
        @break

        @case('whatsapp')
            @livewire('dashboard.whatsapp')
        @break

        @default
    @endswitch
</x-layouts.dashboard>
