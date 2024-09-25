<x-layouts.dashboard>
    @switch($purpose)
        @case('/')
            @livewire('dashboard.welcome')
        @break

        @case('products')
            @livewire('dashboard.products')
        @break

        @case('users')
        @livewire('dashboard.users')
        @break

        @case('whatsapp')
            @livewire('dashboard.whatsapp')
        @break

        @case('orders')
            @livewire('dashboard.orders')
        @break

        @default
    @endswitch
</x-layouts.dashboard>
